<?php

use App\Http\Controllers\Auth\TwoFactorController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes: Authentication
|-------------------------------------------------------------------------------
*/

Route::controller(TwoFactorController::class)->group(function () {

    Route::prefix('two-factor')->name('two-factor.')->group(function () {

        Route::get('verify',  'verifyForm')->name('verify');
        Route::post('verify', 'verify'    );

    });

});
