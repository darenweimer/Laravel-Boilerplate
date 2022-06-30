<?php

use App\Enums\DataTypes;
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
            DataTypes::String  => (string) $data->value,
            DataTypes::Integer => (int) $data->value,
            DataTypes::Float   => (float) $data->value,
            DataTypes::Decimal => new Decimal($data->value),
            DataTypes::Array   => json_decode($data->value, true),
            DataTypes::Object  => json_decode($data->value, false),
            default            => $data->value,
        };
    }

    return $default;
}

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
