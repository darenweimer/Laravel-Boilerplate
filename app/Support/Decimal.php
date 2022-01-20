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

            $this->value = bcadd($value, 0, $this->precision);

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
     * @return string
     */
    public function value() : string
    {
        if (!$this->formatted) {
            $this->value = $this->format($this->value);

            $this->formatted = true;
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
     * @return Decimal
     */
    public function setPrecision(int $precision) : Decimal
    {
        return new static($this->value, $precision);
    }

    /**
     * Adds a value to the decimal value
     *
     * @param string $value
     *
     * @return Decimal
     */
    public function add(string $value) : Decimal
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
     * @return Decimal
     */
    public function subtract(string $value) : Decimal
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
     * @return Decimal
     */
    public function multiply(string $value) : Decimal
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
     * @return Decimal
     */
    public function divide(string $value) : Decimal
    {
        return new static(
            bcdiv($this->value, $value, $this->precision), $this->precision
        );
    }

    /**
     * Floors the decimal value with an optional divisor
     *
     * @param string $divisor
     *
     * @return Decimal
     */
    public function floor(string $divisor = '1') : Decimal
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
