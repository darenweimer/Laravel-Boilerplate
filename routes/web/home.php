<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|-------------------------------------------------------------------------------
| Web Routes: Home
|-------------------------------------------------------------------------------
*/

Route::get('/', fn() => Inertia::render('welcome'));

Route::get('/theme', fn() => Inertia::render('theme'));
