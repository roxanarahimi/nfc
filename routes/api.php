<?php

use App\Http\Controllers\ScanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::options('/{any}', function (Request $request) {
//    return response('', 200)
//        ->header('Access-Control-Allow-Origin', '*')//aa
//        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
//        ->header('Access-Control-Allow-Credentials', 'true');
//})->where('any', '.*');

Route::apiResource('scan', ScanController::class);

Route::controller(UserController::class)->group(function () {
    Route::post('/user/otp', 'sendOtp');
    Route::post('/user/verify', 'verifyMobile');

    Route::get('/broker', 'brokers');
    Route::get('/broker/{id}', 'broker');
    Route::get('/customer', 'customers');
    Route::get('/customer/{id}', 'customer');
});

