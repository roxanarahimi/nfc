<?php

use App\Http\Controllers\ScanController;
use Illuminate\Support\Facades\Route;

//Route::options('/{any}', function (Request $request) {
//    return response('', 200)
//        ->header('Access-Control-Allow-Origin', '*')//aa
//        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
//        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With')
//        ->header('Access-Control-Allow-Credentials', 'true');
//})->where('any', '.*');

Route::apiResource('scan', ScanController::class);


Route::controller(ScanController::class)->group(function () {
    Route::get('/broker', 'test');
});

