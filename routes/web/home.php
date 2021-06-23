<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes: Home
|--------------------------------------------------------------------------
|
| These are the web routes that provide access to home views. These views are
| outside of any authentication.
|
*/

Route::get('/', fn() => Inertia::render('welcome'));

Route::get('/theme', fn() => Inertia::render('theme'));
