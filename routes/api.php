<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\Auth\ApiLoginController;
use App\Http\Controllers\Api\User\Auth\ApiLogoutController;
use App\Http\Controllers\Api\User\Auth\ApiRegisterController;
use App\Http\Controllers\Api\User\Auth\ApiChangePasswordController;


Route::group([
    'prefix' => 'v1',
], function () {
    Route::post('login', [ApiLoginController::class, 'login']);
    Route::post('register', [ApiRegisterController::class, 'register']);
    Route::group(['middleware' => ['auth:api']], function () {
        Route::post('change_password', [ApiChangePasswordController::class, 'changePassword']);
        Route::post('logout', [ApiLogoutController::class, 'logout']);
    });
});
