<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use App\Models\Traits\UserSettings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use DateDisplay, HasFactory, Notifiable, Revisions, SoftDeletes, UserSettings;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'google2fa',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'google2fa',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'google2fa'         => 'encrypted',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'google2fa_enabled',
    ];

    /**
     * The relationships that should always be loaded
     *
     * @var array
     */
    protected $with = [
        'settings',
    ];

    /**
     * Returns true if Google 2fa is enabled
     *
     * @return bool
     */
    public function getGoogle2faEnabledAttribute() : bool
    {
        return (bool) $this->google2fa;
    }

    /**
     * Generates the user's Google 2fa QR code inline image
     *
     * @return string|null
     */
    public function getGoogle2faQrCodeInlineAttribute() : ?string
    {
        if (!$this->google2fa) {
            return null;
        }

        return app('pragmarx.google2fa')->getQRCodeInline(
            config('app.name'), $this->email, $this->google2fa
        );
    }

    /**
     * Relationship 1:1
     *
     * Gets the user settings associated with the user
     */
    public function settings()
    {
        return $this->hasOne(UserSetting::class);
    }

    /**
     * Enables Google 2fa with a new secret key
     *
     * @return User
     */
    public function enable2fa() : User
    {
        $this->google2fa = app('pragmarx.google2fa')->generateSecretKey();

        return $this;
    }

    /**
     * Disables Google 2fa by clearing the secret key
     *
     * @return User
     */
    public function disable2fa() : User
    {
        $this->google2fa = null;

        return $this;
    }

}
