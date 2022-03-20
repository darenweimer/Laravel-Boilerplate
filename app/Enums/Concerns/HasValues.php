<?php

namespace App\Enums\Concerns;

trait HasValues
{

    /**
     * Retrieves all enum names as an array
     *
     * @return array
     */
    public static function names() : array
    {
        $names = [];

        foreach (static::cases() as $case) {
            $names[] = $case->name;
        }

        return $names;
    }

    /**
     * Retrieves all enum values as an array
     *
     * @return array
     */
    public static function values() : array
    {
        $values = [];

        foreach (static::cases() as $case) {
            $values[] = $case->value;
        }

        return $values;
    }

    /**
     * Retrieves all enum name/value pairs as an associative array
     *
     * @return array
     */
    public static function pairs() : array
    {
        $pairs = [];

        foreach (static::cases() as $case) {
            $pairs[$case->name] = $case->value;
        }

        return $pairs;
    }

}
