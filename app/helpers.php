<?php

use App\Models\Setting;

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
    preg_match_all('/[^\(\)\|\&]+/', $expression, $matches);

    $matches = array_filter(
        array_map('trim', $matches[0])
    );

    $seek = [];

    $replace = [];

    foreach ($matches as $match) {
        $seek[] = $match;

        $replace[] = in_array($match, $array) ? 'true' : 'false';
    }

    $expression = str_replace($seek, $replace, $expression);

    return eval("return {$expression};");
}

/**
 * Gets a setting from the database
 *
 * @param string $setting
 * @param mixed $default
 *
 * @return mixed
 */
function get_setting(string $setting, mixed $default = null) : mixed
{
    $model = Setting::where('setting', $setting)
        ->first();

    if ($model && ((!$model->expires_at) || ($model->expires_at > time()))) {
        return $model->value;
    }

    return $default;
}

/**
 * Puts a setting in the database
 *
 * @param string $setting
 * @param mixed $value
 * @param int $expiresAt
 *
 * @return void
 */
function put_setting(string $setting, mixed $value, int $expiresAt = null) : void
{
    Setting::updateOrCreate([
        'setting'    => $setting,
    ], [
        'value'      => $value,
        'expires_at' => $expiresAt,
    ]);
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
