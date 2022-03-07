<?php

namespace App\Enums\Concerns;

use Illuminate\Support\Arr;

trait HasValues
{

    /**
     * Retrieves all enum values as an array
     *
     * @return array
     */
    public static function values() : array
    {
        return Arr::pluck(
            static::cases(), 'value'
        );
    }

}
