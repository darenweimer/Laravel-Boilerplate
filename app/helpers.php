<?php

use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| Global Helpers
|--------------------------------------------------------------------------
|
| Here is where you can create global helper functions for your application.
| These functions will be accessible as soon as the application loads.
|
*/

/**
 * Gets a setting from the database
 *
 * @param string $setting
 * @param mixed $default
 *
 * @return mixed
 */
function get_setting(string $setting, $default = null)
{
    $model = Setting::where('setting', $setting)->first();

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
function put_setting(string $setting, $value, int $expiresAt = null)
{
    $model = Setting::where('setting', $setting)->first();

    if (!$model) {
        $model = Setting::create([
            'setting' => $setting,
        ]);
    }

    $model->value = $value;
    $model->expires_at = $expiresAt;

    $model->save();
}
