<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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
            'tableRows' => DB::table('users')
                ->orderBy('id')
                ->select([
                    'id',
                    'first_name',
                    'last_name',
                    'email',
                ])
                ->get(),
        ]);
    }

}
