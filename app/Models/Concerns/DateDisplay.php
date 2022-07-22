<?php

namespace App\Models\Concerns;

use DateTimeInterface;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait DateDisplay
{
    /**
     * Returns a timestamp as a DateTime object
     *
     * @param mixed $value
     *
     * @return Carbon
     */
    protected function asDateTime(mixed $value): Carbon
    {
        $date = parent::asDateTime($value);

        if ($timezone = Auth::user()?->timezone) {
            $date->timezone($timezone);
        }

        return $date;
    }

    /**
     * Prepares a date for array / JSON serialization
     *
     * @param DateTimeInterface $date
     *
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('c');
    }
}
