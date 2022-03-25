<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthenticationRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class AuthenticationController extends Controller
{

    /**
     * Handles a web route
     *
     * GET /login
     *
     * @return mixed
     */
    public function loginForm() : mixed
    {
        return Inertia::render('auth/login');
    }

    /**
     * Handles a web route
     *
     * POST /login
     *
     * @param AuthenticationRequest $request
     *
     * @return mixed
     */
    public function login(AuthenticationRequest $request) : mixed
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handles a web route
     *
     * GET /logout
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function logout(Request $request) : mixed
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(RouteServiceProvider::HOME);
    }

}
