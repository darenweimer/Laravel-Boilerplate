<?php

use Illuminate\Support\Facades\Route;

/*
|---------------------------------------------------------------------------
| Web Routes: Auth
|---------------------------------------------------------------------------
|
| These are the web routes that provide basic application authentication.
|
*/

Route::namespace('Auth')->group(function () {

    Route::get('login', 'LoginController@loginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');

    Route::prefix('password')->name('password.')->group(function () {

        Route::get('reset', 'ForgotPasswordController@linkRequestForm')->name('request');
        Route::post('email', 'ForgotPasswordController@sendResetLinkEmail')->name('email');

        Route::get('reset/{token}', 'ResetPasswordController@resetForm')->name('reset');
        Route::post('reset', 'ResetPasswordController@reset')->name('update');

    });

});
