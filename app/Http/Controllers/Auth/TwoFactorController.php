<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\TwoFactorRequest;
use App\Providers\RouteServiceProvider;
use Inertia\Inertia;

class TwoFactorController extends Controller
{

    /**
     * Where to redirect users after verification
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Handles a web route
     *
     * GET /two-factor/verify
     *
     * @return mixed
     */
    public function verifyForm() : mixed
    {
        return Inertia::render('auth/two-factor/verify');
    }

    /**
     * Handles a web route
     *
     * POST /two-factor/verify
     *
     * @param TwoFactorRequest $request
     *
     * @return mixed
     */
    public function verify(TwoFactorRequest $request) : mixed
    {
        $request->session()
            ->put('two_factor_verified', true);

        return redirect($this->redirectTo);
    }

}
