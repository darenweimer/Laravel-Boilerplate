<?php

namespace App\Enums\Concerns;

trait HasValues
{
    /**
     * Retrieves all enum names as an array
     *
     * @return array
     */
    public static function names(): array
    {
        return array_column(
            static::cases(),
            'name'
        );
    }

    /**
     * Retrieves all enum labels as an array
     *
     * @return array
     */
    public static function labels(): array
    {
        return array_map(
            fn ($name) => ltrim(
                preg_replace(
                    '/[\s_]+/',
                    ' ',
                    preg_replace('/(?<!\ )[A-Z]/', ' $0', $name)
                )
            ),
            array_column(
                static::cases(),
                'name'
            )
        );
    }

    /**
     * Retrieves all enum values as an array
     *
     * @return array
     */
    public static function values(): array
    {
        return array_column(
            static::cases(),
            'value'
        );
    }

    /**
     * Retrieves all enum name/value pairs as an associative array
     *
     * @return array
     */
    public static function namesValues(): array
    {
        $pairs = [];

        foreach (static::cases() as $case) {
            $pairs[$case->name] = $case->value;
        }

        return $pairs;
    }

    /**
     * Retrieves all enum label/value pairs as an associative array
     *
     * @return array
     */
    public static function labelsValues(): array
    {
        $pairs = [];

        foreach (static::cases() as $case) {
            $pairs[
                ltrim(
                    preg_replace(
                        '/[\s_]+/',
                        ' ',
                        preg_replace('/(?<!\ )[A-Z]/', ' $0', $case->name)
                    )
                )
            ] = $case->value;
        }

        return $pairs;
    }
}
