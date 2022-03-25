<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class RegistrationController extends Controller
{

    /**
     * Handles a web route
     *
     * GET /register
     *
     * @return mixed
     */
    public function registerForm() : mixed
    {
        return Inertia::render('auth/register');
    }

    /**
     * Handles a web route
     *
     * POST /register
     *
     * @param RegistrationRequest $request
     *
     * @return mixed
     */
    public function register(RegistrationRequest $request) : mixed
    {
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
