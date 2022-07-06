<?php

use Illuminate\Support\Facades\Route;

/*
|-------------------------------------------------------------------------------
| Web Routes
|-------------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__ . '/web/home.php';

require __DIR__ . '/web/auth.php';

Route::middleware(['auth', 'auth.2fa', 'auth.compromised'])->group(function () {

    // require __DIR__ . '/web/routes.php';

});
