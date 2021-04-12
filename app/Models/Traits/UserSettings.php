<?php

namespace App\Models\Traits;

use App\Models\UserSetting;

trait UserSettings
{

    /**
     * Handles the model's 'created' event
     *
     * @return void
     */
    protected function userSetttingsAfterCreated()
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
    protected function userSetttingsAfterDeleted()
    {
        UserSetting::find($this->id)->delete();
    }

    /**
     * Handles the model's 'restored' event
     *
     * @return void
     */
    protected function userSetttingsAfterRestored()
    {
        UserSetting::withTrashed()->find($this->id)->restore();
    }

    /**
     * Bootstraps the model's event handlers
     *
     * @return void
     */
    public static function bootUserSettings()
    {
        static::created(function ($model) {
            $model->userSetttingsAfterCreated();
        });

        static::deleted(function ($model) {
            $model->userSetttingsAfterDeleted();
        });

        if (method_exists(static::class, 'restored')) {
            static::restored(function ($model) {
                $model->userSetttingsAfterRestored();
            });
        }
    }

}
