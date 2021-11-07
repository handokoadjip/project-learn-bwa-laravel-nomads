<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Route::get('/detail/{slug}', 'DetailController@index')->name('detail');

Route::prefix('checkout')
    ->middleware('auth', 'verified')
    ->group(function () {
        Route::get('/{transaction_id}', 'CheckoutController@index')->name('checkout');
        Route::post('/{travel_id}', 'CheckoutController@process')->name('checkout.process');
        Route::post('/create/{transaction_id}', 'CheckoutController@create')->name('checkout.create');
        Route::get('/remove/{transaction_detail_id}', 'CheckoutController@remove')->name('checkout.remove');
        Route::get('/success/{transaction_id}', 'CheckoutController@sucess')->name('checkout.sucess');
    });

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::resource('travel', 'TravelController');
        Route::resource('travel-photo', 'TravelPhotoController');
        Route::resource('transaction', 'TransactionController');
    });

Auth::routes(['verify' => true]);

// Midtrans

Route::post('midtrans/callback', 'MidtransController@notificationHandler');
Route::get('midtrans/finish', 'MidtransController@finishRedirect');
Route::get('midtrans/unfinish', 'MidtransController@unfinishRedirect');
Route::get('midtrans/error', 'MidtransController@errorRedirect');
