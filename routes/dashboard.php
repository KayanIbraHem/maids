<?php

use App\Models\Maid\Maid;
use App\Models\Term\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\ServiceType\ServiceType;
use App\Http\Controllers\Dashboard\Maid\MaidController;
use App\Http\Controllers\Dashboard\Term\TermController;
use App\Http\Controllers\Dashboard\Admin\AdminController;
use App\Http\Controllers\Dashboard\Policy\PolicyController;
use App\Http\Controllers\Dashboard\Admin\Auth\LoginController;
use App\Http\Controllers\Dashboard\Admin\Auth\LogoutController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\Nationality\NationalityController;
use App\Http\Controllers\Dashboard\ServiceType\ServiceTypeController;
use App\Http\Controllers\Dashboard\Admin\Auth\ChangePasswordController;
use App\Http\Controllers\Dashboard\NationalityType\NationalityTypeController;
use App\Http\Controllers\Dashboard\EndPoint\Nationality\FetchNationalityController;
use App\Http\Controllers\Dashboard\EndPoint\ServiceType\FetchServiceTypeController;

Route::group([
    'prefix' => 'dashboard',
], function () {
    Route::post('login', [LoginController::class, 'login']);

    Route::group(['middleware' => ['auth:admin']], function () {
        //CHANGE PASSWORD
        Route::post('change_password', [ChangePasswordController::class, 'changePassword']);
        //LOGOUT
        Route::post('logout', [LogoutController::class, 'logout']);
        Route::group(['middleware' => ['superAdmin']], function () {
            //ADMIN
            Route::controller(AdminController::class)->group(function () {
                Route::post('store_admin', 'store');
                Route::get('admins', 'index');
                Route::post('update_admin/{admin}', 'update');
                Route::get('show_admin/{admin}', 'show');
                Route::delete('delete_admin/{admin}', 'delete');
            });
            //SETTINGS
            Route::controller(SettingsController::class)->group(function () {
                Route::post('store_settings', 'store');
                Route::get('settings', 'index');
                Route::get('show_settings/{settings}', 'show');
                Route::delete('delete_settings/{settings}', 'delete');
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
        //NATIONALITY TYPE
        Route::controller(NationalityTypeController::class)->group(function () {
            Route::post('store_nationality_type', 'store');
            Route::any('nationality_types', 'index');
            Route::post('update_nationality_type/{nationality_type}', 'update');
            Route::get('show_nationality_type/{nationality_type}', 'show');
            Route::delete('delete_nationality_type/{nationality_type}', 'delete');
        });
        //TERM
        Route::controller(TermController::class)->group(function () {
            Route::post('store_term', 'store');
            Route::get('terms', 'index');
            Route::post('update_term/{term}', 'update');
            Route::get('show_term/{term}', 'show');
            Route::delete('delete_term/{term}', 'delete');
        });
        //POLICY
        Route::controller(PolicyController::class)->group(function () {
            Route::post('store_policy', 'store');
            Route::get('policies', 'index');
            Route::post('update_policy/{policy}', 'update');
            Route::get('show_policy/{policy}', 'show');
            Route::delete('delete_policy/{policy}', 'delete');
        });
        //MAID
        Route::controller(MaidController::class)->group(function () {
            Route::post('store_maid', 'store');
            Route::any('maids', 'index');
            Route::post('update_maid/{maid}', 'update');
            Route::get('show_maid/{maid}', 'show');
            Route::delete('delete_maid/{maid}', 'delete');
        });
        //END POINTS
        //SERVICETYPE
        Route::get('fetch_service_types', FetchServiceTypeController::class);
        //NATIONALITY
        Route::get('fetch_nationalities', FetchNationalityController::class);
    });
});
