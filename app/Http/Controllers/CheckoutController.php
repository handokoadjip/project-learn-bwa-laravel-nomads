<?php

namespace App\Http\Controllers;

use Mail;
use App\Mail\TransactionSuccess;

use Midtrans\Config;
use Midtrans\Snap;

use App\Travel;
use App\Transaction;
use App\TransactionDetail;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        return view('pages.checkout', compact('transaction'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function process($travel_id)
    {
        $travel = Travel::findOrFail($travel_id);
        $user = Auth::user();

        $transaction = Transaction::create([
            'travel_id' => $travel_id,
            'user_id' => $user->id,
            'additional_visa' => 0,
            'transaction_total' => $travel->price,
            'transaction_status' => 'IN_CART'
        ]);

        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'username' => $user->username,
            'nationality' => 'ID',
            'is_visa' => false,
            'doe_passport' => Carbon::now()->addYear(5)
        ]);

        return redirect()->route('checkout', $transaction->id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $transaction_id)
    {
        $request->validate([
            'username' => 'required|string|exists:users,username',
            'is_visa' => 'required|boolean',
            'doe_passport' => 'required'
        ]);

        // Create
        $data = $request->all();
        $data['transaction_id'] = $transaction_id;

        TransactionDetail::create($data);

        // Update 
        $transaction = Transaction::findOrFail($transaction_id);

        if ($request->is_visa) {
            $transaction->additional_visa += 190;
            $transaction->transaction_total += 190;
        }

        $transaction->transaction_total += $transaction->travel->price;

        $transaction->save();

        return redirect()->route('checkout', $transaction_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function remove($transaction_detail_id)
    {
        $transactionDetail = TransactionDetail::findOrFail($transaction_detail_id);

        $transaction = Transaction::findOrFail($transactionDetail->transaction_id);

        if ($transactionDetail->is_visa) {
            $transaction->additional_visa -= 190;
            $transaction->transaction_total -= 190;
        }

        $transaction->transaction_total -= $transaction->travel->price;

        $transaction->save();
        $transactionDetail->delete();

        return redirect()->route('checkout', $transactionDetail->transaction_id);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sucess($transaction_id)
    {
        $transaction = Transaction::findOrFail($transaction_id);
        $transaction->transaction_status = 'Pending';

        $transaction->save();

        // return $transaction->transaction_total;

        // Send to email
        // Mail::to($transaction->user)->send(
        //     new TransactionSuccess($transaction)
        // );

        // return view('pages.checkout-success');

        // Config Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans/is_sanitized');
        Config::$is3ds = config('midtrans/is_3ds');

        // Params
        $params = [
            'transaction_details' => [
                'order_id' => 'TEST-' . $transaction->id,
                'gross_amount' => (int) $transaction->transaction_total
            ],
            'customer_details' => [
                'first_name' => $transaction->user->name,
                'email' => $transaction->user->email
            ],
            'enabled_payments' => ['gopay'],
            'vtweb' => []
        ];

        try {
            // redirect url
            $paymentUrl = Snap::createTransaction($params)->redirect_url;

            // Redirect to Snap Payment Page
            header('Location: ' . $paymentUrl);
            exit();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
