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

Route::get('login',  [LoginController::class, 'loginForm'])->name('login');
Route::post('login', [LoginController::class, 'login'    ]);
Route::get('logout', [LoginController::class, 'logout'   ])->name('logout');

Route::prefix('2fa')->name('2fa.')->group(function () {

    Route::get('login',  [LoginController::class, 'loginForm2fa'])->name('login');
    Route::post('login', [LoginController::class, 'login2fa'    ]);

});

Route::prefix('password')->name('password.')->group(function () {

    Route::get('reset',         [ForgotPasswordController::class, 'linkRequestForm'   ])->name('request');
    Route::post('email',        [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('email');
    Route::get('reset/{token}', [ResetPasswordController::class,  'resetForm'         ])->name('reset');
    Route::post('reset',        [ResetPasswordController::class,  'reset'             ])->name('update');

});
