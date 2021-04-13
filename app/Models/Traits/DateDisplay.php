<?php

namespace App\Models\Traits;

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
    protected function asDateTime($value) : Carbon
    {
        $date = parent::asDateTime($value);

        if ($user = Auth::user()) {
            if (($settings = $user->settings) && $settings->timezone) {
                $date->timezone($settings->timezone);
            }
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
    protected function serializeDate(DateTimeInterface $date) : string
    {
        return $date->format('c');
    }

}