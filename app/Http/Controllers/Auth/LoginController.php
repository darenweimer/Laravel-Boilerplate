<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Google2faRequest;
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
        $this->middleware('guest')
            ->except([
                'logout',
                'loginForm2fa',
                'login2fa',
            ]);
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

    /**
     * Handles a web route
     *
     * GET /2fa/login
     *
     * @return mixed
     */
    public function loginForm2fa()
    {
        return Inertia::render('auth/login2fa');
    }

    /**
     * Handles a web route
     *
     * POST /2fa/login
     *
     * @param Google2faRequest $request
     *
     * @return mixed
     */
    public function login2fa(Google2faRequest $request)
    {
        $request->session()->put('Google2faVerified', true);

        return redirect($this->redirectTo);
    }

}
