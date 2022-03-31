<?php

namespace App\Models\Concerns;

use App\Models\UserSetting;

trait HasUserSettings
{

    /**
     * Handles the model's 'created' event
     *
     * @return void
     */
    protected function hasUserSettingsAfterCreated() : void
    {
        $this->userSettings()
            ->create();
    }

    /**
     * Handles the model's 'deleted' event
     *
     * @return void
     */
    protected function hasUserSettingsAfterDeleted() : void
    {
        $this->userSettings
            ->delete();
    }

    /**
     * Handles the model's 'restored' event
     *
     * @return void
     */
    protected function hasUserSettingsAfterRestored() : void
    {
        $this->userSettings()
            ->withTrashed()
            ->first()
            ->restore();
    }

    /**
     * Bootstraps the model's event handlers
     *
     * @return void
     */
    public static function bootHasUserSettings() : void
    {
        static::created(function ($model) {
            $model->hasUserSettingsAfterCreated();
        });

        static::deleted(function ($model) {
            $model->hasUserSettingsAfterDeleted();
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->hasUserSettingsAfterRestored();
            });
        }
    }

    /**
     * Relationship 1:1
     *
     * Returns the user settings associated with the user
     *
     * @return mixed
     */
    public function userSettings() : mixed
    {
        return $this->hasOne(UserSetting::class);
    }

}
