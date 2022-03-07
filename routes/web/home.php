<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes: Home
|-------------------------------------------------------------------------------
*/

Route::controller(HomeController::class)->group(function () {

    Route::get('/',     'welcome');
    Route::get('theme', 'theme'  )->name('theme');

});
