<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class VerificationController extends Controller
{

    /**
     * Creates a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('throttle:6,1')
            ->only('send');

        $this->middleware('signed')
            ->only('verify');
    }

    /**
     * Handles a web route
     *
     * GET /verification-notice
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function notice(Request $request) : mixed
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()
                ->intended(RouteServiceProvider::HOME);
        }

        return Inertia::render('auth/verification');
    }

    /**
     * Handles a web route
     *
     * GET /verification-verify/{id}/{hash}
     *
     * @param EmailVerificationRequest $request
     *
     * @return mixed
     */
    public function verify(EmailVerificationRequest $request) : mixed
    {
        $request->fulfill();

        return redirect()
            ->intended(RouteServiceProvider::HOME);
    }

    /**
     * Handles a web route
     *
     * POST /verification-send
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function send(Request $request) : mixed
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()
                ->intended(RouteServiceProvider::HOME);
        }

        $request->user()
            ->sendEmailVerificationNotification();

        return back()
            ->with('status', 'A new verification link has been sent to your email address.');
    }

}
