<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Inertia\Inertia;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Creates a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handles a web route
     *
     * GET /login
     *
     * @return mixed
     */
    public function loginForm()
    {
        return Inertia::render('auth/login');
    }

}
