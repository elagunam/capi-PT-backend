<?php

use App\Http\Controllers\ContactAddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactPhoneController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::prefix('contacts')->controller(ContactController::class)->group(function(){
    Route::get('', 'index');
    Route::get('{id}', 'getOneById');
    Route::post('', 'save');
});

Route::prefix('address')->controller(ContactAddressController::class)->group(function(){
    Route::get('{id}', 'getOneById');
    Route::post('', 'save');
    Route::delete('{id}', 'delete');
});

Route::prefix('phones')->controller(ContactPhoneController::class)->group(function(){
    Route::get('{id}', 'getOneById');
    Route::post('', 'save');
    Route::delete('{id}', 'delete');
});


// Route::prefix('auth')->controller(AuthController::class)->group(function(){
//     Route::post('/signin', 'signin');
//     Route::get('/activate/{code}', 'user_activation');
//     Route::post('/forget-password', 'recovery_password_request');
//     Route::post('/change-password', 'change_password_recovery');
//     Route::post('/login', 'web_login');
//     Route::post('/unlock-account-request', 'unlockAccountRequest');
//     Route::get('/unlock-account/{code}', 'unlockAccount');
// });

