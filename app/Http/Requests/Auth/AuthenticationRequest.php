<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class AuthenticationRequest extends FormRequest
{
    /**
     * Gets the rate limiting throttle key for the request
     *
     * @return string
     */
    protected function throttleKey(): string
    {
        return strtolower($this->email) . '|' . $this->ip();
    }

    /**
     * Verifies the login request is not rate limited
     *
     * @return void
     *
     * @throws ValidationException
     */
    protected function validateRateLimiting(): void
    {
        $tooManyAttempts = RateLimiter::tooManyAttempts(
            $this->throttleKey(),
            5
        );

        if (!$tooManyAttempts) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn(
            $this->throttleKey()
        );

        throw ValidationException::withMessages([
            'email' => trans(
                'auth.throttle',
                [
                    'seconds' => $seconds,
                    'minutes' => ceil($seconds / 60),
                ]
            ),
        ]);
    }

    /**
     * Determines if the user is authorized to make this request
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Gets the validation rules that apply to the request
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'email'    => ['required', 'email'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempts to authenticate the request's credentials
     *
     * @return void
     *
     * @throws ValidationException
     */
    public function authenticate(): void
    {
        $this->validateRateLimiting();

        $authenticated = Auth::attempt(
            $this->only('email', 'password'),
            $this->boolean('remember')
        );

        if (!$authenticated) {
            RateLimiter::hit(
                $this->throttleKey()
            );

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear(
            $this->throttleKey()
        );
    }
}
