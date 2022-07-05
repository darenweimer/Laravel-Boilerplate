<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        // $this->middleware('auth.permits:Permissions')
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
        return Inertia::render('theme/index', [
            'tableRows' => User::factory()
                ->count(25)
                ->make(),
        ]);
    }

}
