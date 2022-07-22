<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ForgotPasswordController extends Controller
{
    /**
     * Creates a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        ResetPassword::createUrlUsing(
            fn ($notifiable, $token) => url(
                route('reset-password-form', [
                    'token' => $token,
                    'email' => $notifiable->getEmailForPasswordReset(),
                ], false)
            )
        );
    }

    /**
     * Handles a web route
     *
     * GET /forgot-password
     *
     * @return mixed
     */
    public function requestForm(): mixed
    {
        return Inertia::render('auth/forgot-password');
    }

    /**
     * Handles a web route
     *
     * POST /forgot-password
     *
     * @param ForgotPasswordRequest $request
     *
     * @return mixed
     */
    public function request(ForgotPasswordRequest $request): mixed
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return back()
                ->with('status', __($status));
        }

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' => __($status),
            ]);
    }

    /**
     * Handles a web route
     *
     * GET /reset-password
     *
     * @param string $token
     * @param string $email
     *
     * @return mixed
     */
    public function resetForm(string $token, string $email): mixed
    {
        return Inertia::render('auth/reset-password', [
            'token' => $token,
            'email' => $email,
        ]);
    }

    /**
     * Handles a web route
     *
     * POST /reset-password
     *
     * @param ResetPasswordRequest $request
     *
     * @return mixed
     */
    public function reset(ResetPasswordRequest $request): mixed
    {
        $status = Password::reset(
            $request->only([
                'token',
                'email',
                'password',
                'password_confirmation',
            ]),
            function ($user) use ($request) {
                $user->forceFill([
                    'password'       => Hash::make($request->password),
                    'remember_token' => Str::random(60),
                ])
                ->save();

                event(new PasswordReset($user));
            }
        );

        if ($status === Password::PASSWORD_RESET) {
            return redirect()
                ->route('login')
                ->with('status', __($status));
        }

        return back()
            ->withInput(
                $request->only('email')
            )
            ->withErrors([
                'email' => __($status),
            ]);
    }
}
