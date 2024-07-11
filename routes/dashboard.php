<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Admin\Auth\LoginController;


Route::group([
    'prefix' => 'dashboard',
], function () {

    Route::post('login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['auth:admin']], function () {


    });
});
