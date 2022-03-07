<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ResetPasswordController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes: Authentication
|-------------------------------------------------------------------------------
*/

Route::controller(LoginController::class)->group(function () {

    Route::get('login',  'loginForm')->name('login');
    Route::post('login', 'login'    );
    Route::get('logout', 'logout'   )->name('logout');

    Route::prefix('2fa')->name('2fa.')->group(function () {

        Route::get('login',  'loginForm2fa')->name('login');
        Route::post('login', 'login2fa'    );

    });

});

Route::prefix('password')->name('password.')->group(function () {

    Route::controller(ForgotPasswordController::class)->group(function () {

        Route::get('reset',  'linkRequestForm'   )->name('request');
        Route::post('email', 'sendResetLinkEmail')->name('email');

    });

    Route::controller(ResetPasswordController::class)->group(function () {

        Route::get('reset/{token}', 'resetForm')->name('reset');
        Route::post('reset',        'reset'    )->name('update');

    });

});
