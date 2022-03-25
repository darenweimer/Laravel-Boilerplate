<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\TwoFactorRequest;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class TwoFactorController extends Controller
{

    /**
     * Handles a web route
     *
     * GET /verify-2fa
     *
     * @return mixed
     */
    public function verifyForm() : mixed
    {
        return Inertia::render('auth/two-factor');
    }

    /**
     * Handles a web route
     *
     * POST /verify-2fa
     *
     * @param TwoFactorRequest $request
     *
     * @return mixed
     */
    public function verify(TwoFactorRequest $request) : mixed
    {
        $request->session()
            ->put('two_factor_verified', true);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

}
