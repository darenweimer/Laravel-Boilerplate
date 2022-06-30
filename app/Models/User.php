<?php

namespace App\Models;

use App\Enums\NotifyOptions;
use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\HasPermissions;
use App\Models\Concerns\HasRevisions;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // implements MustVerifyEmail
{
    use DateDisplay, HasApiTokens, HasFactory, HasPermissions, HasRevisions, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'two_factor_secret',
        'su',
        'compromised',
        'timezone',
        'notify_exceptions',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_secret' => 'encrypted',
        'su'                => 'boolean',
        'compromised'       => 'boolean',
        'notify_exceptions' => NotifyOptions::class,
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'two_factor_secret',
        'remember_token',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'two_factor_enabled',
    ];

    /**
     * Interacts with the 'two_factor_enabled' attribute
     *
     * @return Attribute
     */
    protected function twoFactorEnabled() : Attribute
    {
        return Attribute::make(
            get: fn() => (bool) $this->two_factor_secret,
        );
    }

    /*
    |---------------------------------------------------------------------------
    | Methods
    |---------------------------------------------------------------------------
    */

    /**
     * Enables two-factor authentication with a new secret key
     *
     * @return static
     */
    public function enableTwoFactor() : static
    {
        $this->two_factor_secret = app('pragmarx.google2fa')
            ->generateSecretKey();

        return $this;
    }

    /**
     * Disables two-factor authentication by clearing the secret key
     *
     * @return static
     */
    public function disableTwoFactor() : static
    {
        $this->two_factor_secret = null;

        return $this;
    }

    /**
     * Generates the user's two-factor authentication QR code inline image
     *
     * @return string|null
     */
    public function getTwoFactorQrCode() : ?string
    {
        if (!$this->two_factor_secret) {
            return null;
        }

        return app('pragmarx.google2fa')
            ->getQRCodeInline(
                config('app.name'), $this->email, $this->two_factor_secret
            );
    }

}
