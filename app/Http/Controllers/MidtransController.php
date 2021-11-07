<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use Midtrans\Config;
use Midtrans\Notification;

use App\Mail\TransactionSuccess;
use App\Transaction;

class MidtransController extends Controller
{
    public function notificationHandler(Request $request)
    {
        // Config Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans/is_sanitized');
        Config::$is3ds = config('midtrans/is_3ds');


        // instance notificarion midtrans
        $notification = new Notification();


        $status = $notification->status;
        $type = $notification->payment_type;
        $fraud = $notification->fraud;
        $order_id = explode('-', $notification->order_id)[1];

        // get transaction id
        $transaction = Transaction::findOrFail($order_id);

        if ($status == 'capture') {
            if ($type == 'credit_card') {
                if ($fraud == 'challenge') {
                    $transaction->transaction_status = 'CHALLENGE';
                } else {
                    $transaction->transaction_status = 'SUCCESS';
                }
            }
        } elseif ($status == 'settlement') {
            $transaction->transaction_status = 'SUCCESS';
        } elseif ($status == 'pending') {
            $transaction->transaction_status = 'PENDING';
        } elseif ($status == 'deny' || $status == 'cancel') {
            $transaction->transaction_status = 'FAILED';
        } elseif ($status == 'expire') {
            $transaction->transaction_status = 'EXPIRED';
        }

        // save transaction
        $transaction->save();

        // send mail
        if ($transaction) {
            if ($status == 'capture' && $fraud == 'accept') {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } elseif ($status == 'settlement') {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } elseif ($status == 'success') {
                Mail::to($transaction->user)->send(
                    new TransactionSuccess($transaction)
                );
            } elseif ($status == 'capture' && $fraud == 'challenge') {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans payment challenge'
                    ]
                ]);
            } else {
                return response()->json([
                    'meta' => [
                        'code' => 200,
                        'message' => 'Midtrans payment not settlement'
                    ]
                ]);
            }

            return response()->json([
                'meta' => [
                    'code' => 200,
                    'message' => 'Midtrans notification success'
                ]
            ]);

            // and then go to verify csrf
        }
    }

    public function finishRedirect(Request $request)
    {
        return view('pages.chekcout-success');
    }

    public function unfinishRedirect(Request $request)
    {
        return view('pages.chekcout-unfinish');
    }

    public function errorRedirect(Request $request)
    {
        return view('pages.chekcout-error');
    }
}
