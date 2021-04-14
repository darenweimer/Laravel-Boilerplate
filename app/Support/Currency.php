<?php

namespace App\Support;

use InvalidArgumentException;

class Currency
{

    /**
     * The default precision for currency calculations
     *
     * @var int
     */
    protected static $precision = 20;

    /**
     * Sets the default precision for currency calculations
     *
     * @param int $precision
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public static function precision(int $precision)
    {
        if ($precision < 0) {
            throw new InvalidArgumentException(
                "Invalid currency precision: {$precision}"
            );
        }

        static::$precision = $precision;
    }

    /**
     * Formats a currency value
     *
     * @param string $value
     *
     * @return string
     */
    public static function format(string $value) : string
    {
        if (strpos($value, '.') !== false) {
            $value = rtrim($value, '0');
            $value = rtrim($value, '.');

            if (substr($value, 0, 1) === '.') {
                $value = "0{$value}";
            }
        }

        if (!$value) {
            $value = '0';
        }

        return $value;
    }

    /**
     * Adds a list of currency values
     *
     * @param string $initial
     * @param array ...$additional
     *
     * @return string
     */
    public static function add(string $initial, ...$additional) : string
    {
        foreach ($additional as $value) {
            $initial = bcadd($initial, $value, static::$precision);
        }

        return static::format($initial);
    }

    /**
     * Subtracts a list of currency values
     *
     * @param string $initial
     * @param array ...$additional
     *
     * @return string
     */
    public static function subtract(string $initial, ...$additional) : string
    {
        foreach ($additional as $value) {
            $initial = bcsub($initial, $value, static::$precision);
        }

        return static::format($initial);
    }

    /**
     * Multiplies a list of currency values
     *
     * @param string $initial
     * @param array ...$additional
     *
     * @return string
     */
    public static function multiply(string $initial, ...$additional) : string
    {
        foreach ($additional as $value) {
            $initial = bcmul($initial, $value, static::$precision);
        }

        return static::format($initial);
    }

    /**
     * Divides a list of currency values
     *
     * @param string $initial
     * @param array ...$additional
     *
     * @return string
     */
    public static function divide(string $initial, ...$additional) : string
    {
        foreach ($additional as $value) {
            $initial = bcdiv($initial, $value, static::$precision);
        }

        return static::format($initial);
    }

    /**
     * Calculates a list of currency values
     *
     * Each element in $additional should start with a sign (+, -, *, /) that
     * indicates how it should be applied to $initial.
     *
     * @param string $initial
     * @param array ...$additional
     *
     * @return string
     *
     * @throws InvalidArgumentException
     */
    public static function calculate(string $initial, ...$additional) : string
    {
        foreach ($additional as $value) {
            $sign = substr($value, 0, 1);

            $value = substr($value, 1);

            switch ($sign) {
                case '+':
                    $initial = bcadd($initial, $value, static::$precision);
                    break;
                case '-':
                    $initial = bcsub($initial, $value, static::$precision);
                    break;
                case '*':
                    $initial = bcmul($initial, $value, static::$precision);
                    break;
                case '/':
                    $initial = bcdiv($initial, $value, static::$precision);
                    break;
                default:
                    throw new InvalidArgumentException(
                        'No sign given to indicate calculation type.'
                    );
            }
        }

        return static::format($initial);
    }

    /**
     * Compares two currency values
     *
     * @param string $left
     * @param string $right
     *
     * @return int
     */
    public static function compare(string $left, string $right) : int
    {
        return bccomp($left, $right, static::$precision);
    }

}
