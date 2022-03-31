<?php

namespace App\Models\Concerns;

use App\Models\UserSetting;

trait UserSettings
{

    /**
     * Handles the model's 'created' event
     *
     * @return void
     */
    protected function userSettingsAfterCreated() : void
    {
        UserSetting::create([
            'user_id' => $this->id,
        ]);
    }

    /**
     * Handles the model's 'deleted' event
     *
     * @return void
     */
    protected function userSettingsAfterDeleted() : void
    {
        UserSetting::find($this->id)->delete();
    }

    /**
     * Handles the model's 'restored' event
     *
     * @return void
     */
    protected function userSettingsAfterRestored() : void
    {
        UserSetting::withTrashed()->find($this->id)->restore();
    }

    /**
     * Bootstraps the model's event handlers
     *
     * @return void
     */
    public static function bootUserSettings() : void
    {
        static::created(function ($model) {
            $model->userSettingsAfterCreated();
        });

        static::deleted(function ($model) {
            $model->userSettingsAfterDeleted();
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->userSettingsAfterRestored();
            });
        }
    }

}
