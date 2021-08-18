<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ExceptionNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The exception details
     *
     * @var array
     */
    protected $exception = null;

    /**
     * Creates a new message instance
     *
     * @param Throwable $exception
     *
     * @return void
     */
    public function __construct(Throwable $exception)
    {
        $this->exception = [
            'class'   => get_class($exception),
            'message' => $exception->getMessage(),
            'file'    => $exception->getFile(),
            'line'    => $exception->getLine(),
            'trace'   => $exception->getTraceAsString(),
        ];
    }

    /**
     * Builds the message
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Application Exception';

        if (($environment = app()->environment()) !== 'production') {
            $subject .= " ({$environment} environment)";
        }

        return $this->subject($subject)
            ->view('mail.exception')
            ->with([
                'exception' => $this->exception,
            ]);
    }

}
