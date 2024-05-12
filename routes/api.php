<?php

use App\Http\Controllers\ContactAddressController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactEmailController;
use App\Http\Controllers\ContactPhoneController;
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

Route::prefix('emails')->controller(ContactEmailController::class)->group(function(){
    Route::get('{id}', 'getOneById');
    Route::post('', 'save');
    Route::delete('{id}', 'delete');
});



