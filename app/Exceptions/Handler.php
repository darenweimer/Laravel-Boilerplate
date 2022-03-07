<?php

namespace App\Exceptions;

use App\Enums\NotifyOptions;
use App\Mail\ExceptionNotification;
use App\Models\User;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Mail;
use Throwable;

class Handler extends ExceptionHandler
{

    /**
     * A list of the exception types that are not reported
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Notifies all notification-enabled users of an exception
     *
     * @param Throwable $e
     *
     * @return void
     */
    protected function notify(Throwable $e) : void
    {
        $users = User::whereHas('userSettings',
            fn($userSettings) => $userSettings->where(
                'notify_exceptions', '<>', 'none'
            )
        )
        ->get();

        foreach ($users as $user) {
            $via = $user->userSettings->notify_exceptions;

            if (in_array($via, [NotifyOptions::Email, NotifyOptions::Both])) {
                Mail::to($user)
                    ->queue(new ExceptionNotification($e));
            }

            if (in_array($via, [NotifyOptions::Text, NotifyOptions::Both])) {
                // Send text notification
            }
        }
    }

    /**
     * Registers the exception handling callbacks for the application
     *
     * @return void
     */
    public function register() : void
    {
        $this->reportable(function (Throwable $e) {
            $this->notify($e);
        });
    }

}
