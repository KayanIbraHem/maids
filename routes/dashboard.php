<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ServiceType\ServiceType;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Admin\Auth\LoginController;
use App\Http\Controllers\Dashboard\Nationality\NationalityController;
use App\Http\Controllers\Dashboard\ServiceType\ServiceTypeController;

Route::group([
    'prefix' => 'dashboard',
], function () {

    Route::post('login', [LoginController::class, 'login']);
    Route::group(['middleware' => ['auth:admin']], function () {
        Route::group(['middleware' => ['superAdmin']], function () {
            //ADMIN
            Route::controller(AdminController::class)->group(function () {
                Route::post('store_admin', 'store');
                Route::get('admins', 'index');
                Route::post('update_admin/{admin}', 'update');
                Route::get('show_admin/{admin}', 'show');
                Route::delete('delete_admin/{admin}', 'delete');
            });
        });
        //SERVICETYPE
        Route::controller(ServiceTypeController::class)->group(function () {
            Route::post('store_service_type', 'store');
            Route::get('service_types', 'index');
            Route::post('update_service_type/{serviceType}', 'update');
            Route::get('show_service_type/{serviceType}', 'show');
            Route::delete('delete_service_type/{serviceType}', 'delete');
        });
        //NATIONALITY
        Route::controller(NationalityController::class)->group(function () {
            Route::post('store_nationality', 'store');
            Route::get('nationalities', 'index');
            Route::post('update_nationality/{nationality}', 'update');
            Route::get('show_nationality/{nationality}', 'show');
            Route::delete('delete_nationality/{nationality}', 'delete');
        });
    });
});
