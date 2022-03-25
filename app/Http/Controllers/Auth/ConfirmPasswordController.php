<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class ConfirmPasswordController extends Controller
{

    /**
     * Handles a web route
     *
     * GET /confirm-password
     *
     * @return mixed
     */
    public function confirmForm() : mixed
    {
        return Inertia::render('auth/confirm-password');
    }

    /**
     * Handles a web route
     *
     * POST /confirm-password
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function confirm(Request $request) : mixed
    {
        $validated = Auth::guard('web')
            ->validate([
                'email'    => $request->user()->email,
                'password' => $request->password,
            ]);

        if (!$validated) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        $request->session()
            ->put('auth.password_confirmed_at', time());

        return redirect()->intended(RouteServiceProvider::HOME);
    }

}
