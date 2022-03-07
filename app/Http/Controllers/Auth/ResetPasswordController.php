<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Gets the password reset validation rules
     *
     * @return array
     */
    protected function rules() : array
    {
        return [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => [
                'required',
                'confirmed',
                Password::min(12)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ];
    }

    /**
     * Handles a web route
     *
     * GET /password/reset/{token}
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function resetForm(Request $request)
    {
        return Inertia::render('auth/passwords/reset', [
            'token' => $request->route()->parameter('token'),
            'email' => $request->email,
        ]);
    }

}
