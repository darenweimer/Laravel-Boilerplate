<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class HomeController extends Controller
{

    /**
     * Creates a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth.permissions:Permissions')
        //     ->only([
        //         'route',
        //     ]);
    }

    /**
     * Handles a web route
     *
     * GET /
     *
     * @return mixed
     */
    public function welcome() : mixed
    {
        return Inertia::render('welcome');
    }

    /**
     * Handles a web route
     *
     * GET /theme
     *
     * @return mixed
     */
    public function theme() : mixed
    {
        return Inertia::render('theme');
    }

}
