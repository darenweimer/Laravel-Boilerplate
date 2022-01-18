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
        // $this->middleware('auth.permit:Permission')
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
    public function welcome()
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
    public function theme()
    {
        return Inertia::render('theme');
    }

}
