<?php

namespace App\Models\Casts;

use App\Support\Decimal as DecimalCast;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Decimal implements CastsAttributes
{

    /**
     * Casts the given value
     *
     * @param mixed $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return DecimalCast|null
     */
    public function get(mixed $model, string $key, mixed $value, array $attributes) : ?DecimalCast
    {
        return isset($value)
            ? (new DecimalCast($value))
            : null;
    }

    /**
     * Prepares the given value for storage
     *
     * @param mixed $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     *
     * @return string|null
     */
    public function set(mixed $model, string $key, mixed $value, array $attributes) : ?string
    {
        return isset($value)
            ? ((string) $value)
            : null;
    }

}
