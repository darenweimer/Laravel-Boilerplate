<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegistrationController;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes: Authentication
|-------------------------------------------------------------------------------
*/

Route::middleware(['guest'])->group(function () {

    Route::controller(RegistrationController::class)->group(function () {

        Route::get('register', 'registerForm')->name('register');
        Route::post('register', 'register');

    });

    Route::controller(AuthenticationController::class)->group(function () {

        Route::get('login', 'loginForm')->name('login');
        Route::post('login', 'login');

    });

    Route::controller(ForgotPasswordController::class)->group(function () {

        Route::get('forgot-password', 'requestForm')->name('forgot-password');
        Route::post('forgot-password', 'request');
        Route::get('reset-password/{token}/{email}', 'resetForm')->name('reset-password-form');
        Route::post('reset-password', 'reset')->name('reset-password');

    });

});

Route::middleware(['auth'])->group(function () {

    Route::controller(AuthenticationController::class)->group(function () {

        Route::get('logout', 'logout')->name('logout');

    });

    Route::controller(VerificationController::class)->group(function () {

        Route::get('verification-notice', 'notice')->name('verification.notice');
        Route::get('verification-verify/{id}/{hash}', 'verify')->name('verification.verify');
        Route::post('verification-send', 'send')->name('verification.send');

    });

    Route::controller(ConfirmPasswordController::class)->group(function () {

        Route::get('confirm-password', 'confirmForm')->name('password.confirm');
        Route::post('confirm-password', 'confirm');

    });

    Route::controller(TwoFactorController::class)->group(function () {

        Route::get('verify-2fa', 'verifyForm')->name('verify-2fa');
        Route::post('verify-2fa', 'verify');

    });

});
