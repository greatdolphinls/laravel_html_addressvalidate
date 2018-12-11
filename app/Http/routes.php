<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () { return view('index'); });
Route::get('/product', function() {return view('product');});
Route::get('/price', function () { return view('price'); });
Route::get('/price_free', 'PriceController@price_free');
Route::get('/price_business', 'PriceController@price_business');
Route::get('/price_enterprise', 'PriceController@price_enterprise');

Route::get('/contact', function () { return view('contact'); });
Route::get('/signup', function () { return view('signup'); });
Route::get('/signin', function () { return view('signin');});
Route::get('/resetView/{email}', function ($email) { return view('resetPassword')->with('email', $email);});
Route::get('/logout', 'AuthController@logout');

Route::post('signup', 'AuthController@signup');
Route::post('signin', 'AuthController@signin');
Route::post('forget', 'AuthController@forget');
Route::post('resetView/reset_password', 'AuthController@post_reset_password');
Route::get('/reset_password/{token}', 'AuthController@get_reset_password');


Route::group(['middleware' => ['auth']], function () {
    //

    //  admin   ///
    Route::group(['middleware' => ['admin']], function () {
        //
        Route::get('/admin', 'AdminMissionController@admin');
        Route::get('/suspendClient/{id}','AdminMissionController@suspendClient');
        Route::get('/suspendAllApi/{id}','AdminMissionController@suspendClient');
        Route::get('/removeClient/{id}','AdminMissionController@removeClient');
        Route::get('/viewStatistic/{id}','AdminMissionController@viewStatistic');
        Route::get('/viewTransactions/{id}','AdminMissionController@viewTransactions');
        Route::get('/editClient/{id}','AdminMissionController@editClient');
        Route::get('/editBilling/{id}','AdminMissionController@editBilling');
        Route::post('/downgrade', 'AdminMissionController@downgrade');
        Route::post('/resetPassword', 'AdminMissionController@resetPassword');
        Route::post('/apiExpiry', 'AdminMissionController@apiExpiry');
    });

    Route::get('/dashboard', 'DashboardController@dashboard');
    Route::get('/valid_address', 'ValidAddressController@validAddress');
//Route::get('/summary', 'TransactionController@summary');
    Route::get('/summary_today', 'TransactionController@summary_today');
    Route::get('/summary_complete', 'TransactionController@summary_complete');
    Route::post('/summary_during', 'TransactionController@summary');
    Route::post('/summary_download', 'TransactionController@summary_download');
//Route::get('/summary/{type?}', 'TransactionController@summary');
    Route::get('/documentation', 'ApidocController@apidoc');
    Route::get('/invoice', 'InvoiceController@invoice');
    Route::get('/support', 'SupportController@support');
    Route::get('/account', 'AccountController@account');
    Route::post('/update_account', 'AccountController@update_account');
    Route::post('/change_password', 'AccountController@change_password');
    Route::post('/pay_now', 'InvoiceController@pay_now');
    Route::post('/save_pay', 'InvoiceController@save_pay');
    Route::post('/invoice_during', 'InvoiceController@invoice_during');
    Route::post('/support', 'SupportController@send');
});







/// user ////

Route::post('/change_plan', 'AccountController@change_plan');
Route::post('/change_billing', 'AccountController@change_billing');

Route::post('/contact', 'ContactController@contact');

Route::post('/check_email', 'AuthController@check_email');

Route::get('test', 'TransactionController@test');