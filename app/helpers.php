<?php

use App\Enums\DataType;
use App\Models\Setting;
use App\Support\Decimal;

/*
|-------------------------------------------------------------------------------
| Global Helpers
|-------------------------------------------------------------------------------
|
| These functions will be accessible as soon as the application loads.
|
*/

if (!function_exists('array_matches')) {

    /**
     * Returns true if an array matches an items expression
     *
     * The items expression can be a single item or a combination of items linked
     * by parentheses and the logical operators && and ||.
     *
     * @param array $array
     * @param string $expression
     *
     * @return bool
     */
    function array_matches(array $array, string $expression) : bool
    {
        $conditions = array_filter(
            array_map(
                'trim',
                preg_split(
                    '/([!\(\)\&\|]+)/', $expression, -1, PREG_SPLIT_DELIM_CAPTURE
                )
            )
        );

        $evaluation = '';

        foreach ($conditions as $condition) {
            if (in_array($condition[0], ['!', '(', ')', '&', '|'])) {
                $evaluation .= $condition;
            } else {
                $evaluation .= in_array($condition, $array) ? 'true' : 'false';
            }
        }

        return eval("return {$evaluation};");
    }

}

if (!function_exists('setting')) {

    /**
     * Retrieves an application setting
     *
     * @param string $setting
     * @param mixed $default
     *
     * @return mixed
     */
    function setting(string $setting, mixed $default = null) : mixed
    {
        $data = Setting::where('setting', $setting)
            ->first();

        if ($data && ((!$data->expires_at) || ($data->expires_at > time()))) {
            return match ($data->data_type) {
                DataType::String  => (string) $data->value,
                DataType::Integer => (int) $data->value,
                DataType::Float   => (float) $data->value,
                DataType::Decimal => new Decimal($data->value),
                DataType::Array   => json_decode($data->value, true),
                DataType::Object  => json_decode($data->value, false),
                default            => $data->value,
            };
        }

        return $default;
    }

}

if (!function_exists('stopwatch')) {

    /**
     * Tracks how long a callback takes to execute a certain number of times
     *
     * This function also takes into account the time it takes to run a callback for
     * the same number of iterations and subtracts that time from the final time,
     * yielding a more accurate runtime for the callback itself.
     *
     * @param int $iterations
     * @param callable $callback
     *
     * @return float
     */
    function stopwatch(int $iterations, callable $callback) : float
    {
        $emptyFunc = function () { };

        $startTime = microtime(true);

        for ($i = 0; $i < $iterations; $i++) {
            $emptyFunc();
        }

        $endTime = microtime(true);

        $delta = $endTime - $startTime;

        $startTime = microtime(true);

        for ($i = 0; $i < $iterations; $i++) {
            $callback();
        }

        $endTime = microtime(true);

        return max($endTime - $startTime - $delta, 0);
    }

}
