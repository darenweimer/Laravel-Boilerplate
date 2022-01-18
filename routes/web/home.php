<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes: Home
|-------------------------------------------------------------------------------
*/

Route::get('/',     [HomeController::class, 'welcome']);
Route::get('theme', [HomeController::class, 'theme'  ]);
