<?php

namespace App\Support;

use InvalidArgumentException;

class Decimal
{

    /**
     * The decimal value
     *
     * @var string
     */
    protected $value = '0';

    /**
     * The decimal precision
     *
     * @var int
     */
    protected $precision = 20;

    /**
     * The state of the decimal value's formatting
     *
     * @var bool
     */
    protected $formatted = true;

    /**
     * Resolves an input value
     *
     * This function is necessary because PHP converts long numbers into
     * exponential format and the bcmath functions cannot take exponential
     * numbers as input.
     *
     * @param string $value
     *
     * @return string
     */
    protected function resolveValue(string $value) : string
    {
        if (($strpos = stripos($value, 'e')) !== false) {
            $exponent  = substr($value, $strpos + 2);
            $direction = substr($value, $strpos + 1, 1);

            $decimal = strpos($value, '.');

            $value = str_replace(
                '.', '', substr($value, 0, $strpos)
            );

            if ($decimal === false) {
                $decimal = strlen($value);
            }

            if ($direction === '+') {
                $decimal += $exponent;
            } else {
                $decimal -= $exponent;
            }

            if ($decimal < 0) {
                $value = str_repeat('0', abs($decimal)) . $value;

                $decimal = 0;
            } elseif ($decimal > ($strlen = strlen($value))) {
                $value = $value . str_repeat('0', $decimal - $strlen);
            }

            $value = substr_replace($value, '.', $decimal, 0);
        }

        return bcadd($value, 0, $this->precision);
    }

    /**
     * Formats a decimal value
     *
     * @param string $value
     *
     * @return string
     */
    protected function format(string $value) : string
    {
        $parts = explode('.', $value);

        $value = ltrim($parts[0], '0') ?: '0';

        if (!empty($parts[1])) {
            if ($decimals = rtrim($parts[1], '0')) {
                $value .= ".{$decimals}";
            }
        }

        return $value;
    }

    /**
     * Creates a new class instance
     *
     * @param string $value
     * @param int $precision
     *
     * @return void
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $value = null, int $precision = null)
    {
        if (isset($precision)) {
            if ($precision < 0) {
                throw new InvalidArgumentException(
                    'Decimal precision must be greater than or equal to zero'
                );
            }

            $this->precision = $precision;
        }

        if (isset($value)) {
            if (!is_numeric($value)) {
                throw new InvalidArgumentException(
                    'Cannot instantiate a decimal value that is non-numeric'
                );
            }

            $this->value = $this->resolveValue($value);

            $this->formatted = false;
        }
    }

    /**
     * Gets the decimal value
     *
     * @return string
     */
    public function __toString() : string
    {
        return $this->value();
    }

    /**
     * Gets the decimal value
     *
     * @param int $precision
     *
     * @return string
     */
    public function value(int $precision = null) : string
    {
        if (!$this->formatted) {
            $this->value = $this->format($this->value);

            $this->formatted = true;
        }

        if (isset($precision)) {
            return bcadd($this->value, 0, $precision);
        }

        return $this->value;
    }

    /**
     * Gets the decimal precision
     *
     * @return int
     */
    public function getPrecision() : int
    {
        return $this->precision;
    }

    /**
     * Sets the decimal precision
     *
     * @param int $precision
     *
     * @return static
     */
    public function setPrecision(int $precision) : static
    {
        return new static($this->value, $precision);
    }

    /**
     * Adds a value to the decimal value
     *
     * @param string $value
     *
     * @return static
     */
    public function add(string $value) : static
    {
        return new static(
            bcadd($this->value, $value, $this->precision), $this->precision
        );
    }

    /**
     * Subtracts a value from the decimal value
     *
     * @param string $value
     *
     * @return static
     */
    public function subtract(string $value) : static
    {
        return new static(
            bcsub($this->value, $value, $this->precision), $this->precision
        );
    }

    /**
     * Multiplies the decimal value by a value
     *
     * @param string $value
     *
     * @return static
     */
    public function multiply(string $value) : static
    {
        return new static(
            bcmul($this->value, $value, $this->precision), $this->precision
        );
    }

    /**
     * Divides the decimal value by a value
     *
     * @param string $value
     *
     * @return static
     */
    public function divide(string $value) : static
    {
        return new static(
            bcdiv($this->value, $value, $this->precision), $this->precision
        );
    }

    /**
     * Rounds the decimal value to the specified precision
     *
     * @param int $precision
     *
     * @return static
     */
    public function round(int $precision = 0) : static
    {
        return new static(
            bcdiv(
                bcadd(
                    bcmul(
                        $this->value,
                        $power = bcpow(10, $precision + 1),
                        0
                    ),
                    (strpos($this->value, '-') === 0) ? -5 : 5
                ),
                $power,
                $precision
            )
        );
    }

    /**
     * Floors the decimal value with an optional divisor
     *
     * @param string $divisor
     *
     * @return static
     */
    public function floor(string $divisor = '1') : static
    {
        return new static(
            bcsub(
                $this->value,
                bcmod(
                    $this->value, $divisor, $this->precision
                ),
                $this->precision
            ),
            $this->precision
        );
    }

    /**
     * Compares the decimal value to a value
     *
     * @param string $value
     *
     * @return int
     */
    public function compare(string $value) : int
    {
        return bccomp($this->value, $value, $this->precision);
    }

    /**
     * Returns true if the decimal value is greater than a value
     *
     * @param string $value
     *
     * @return bool
     */
    public function gt(string $value) : bool
    {
        return bccomp($this->value, $value, $this->precision) > 0;
    }

    /**
     * Returns true if the decimal value is greater than or equal to a value
     *
     * @param string $value
     *
     * @return bool
     */
    public function gte(string $value) : bool
    {
        return bccomp($this->value, $value, $this->precision) >= 0;
    }

    /**
     * Returns true if the decimal value is less than a value
     *
     * @param string $value
     *
     * @return bool
     */
    public function lt(string $value) : bool
    {
        return bccomp($this->value, $value, $this->precision) < 0;
    }

    /**
     * Returns true if the decimal value is less than or equal to a value
     *
     * @param string $value
     *
     * @return bool
     */
    public function lte(string $value) : bool
    {
        return bccomp($this->value, $value, $this->precision) <= 0;
    }

}
