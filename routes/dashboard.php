<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' => 'dashboard',
], function () {
    

    Route::get('testdashboard', function () {
        return 'from dashboard';
    });
});
