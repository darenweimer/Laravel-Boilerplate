<?php

use App\Services\Settings\Enums\DataTypes;
use App\Services\Settings\Models\Setting;
use App\Support\Decimal;

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
