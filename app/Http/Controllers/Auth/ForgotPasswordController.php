<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    /**
     * Handles a web route
     *
     * GET /password/reset
     *
     * @return mixed
     */
    public function linkRequestForm() : mixed
    {
        return Inertia::render('auth/passwords/email');
    }

}
