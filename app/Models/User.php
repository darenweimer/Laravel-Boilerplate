<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use App\Models\Traits\UserSettings;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // implements MustVerifyEmail
{
    use DateDisplay, HasApiTokens, HasFactory, Notifiable, Revisions, SoftDeletes, UserSettings;

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
        'roles',
        'permissions',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'two_factor_enabled',
        'roles_list',
        'permissions_list',
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

    /**
     * Interacts with the 'roles_list' attribute
     *
     * @return Attribute
     */
    protected function rolesList() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->roles
                ->pluck('role')
                ->unique()
                ->toArray(),
        );
    }

    /**
     * Interacts with the 'permissions_list' attribute
     *
     * @return Attribute
     */
    protected function permissionsList() : Attribute
    {
        return Attribute::make(
            get: fn() => array_unique(
                array_merge(
                    $this->roles
                        ->pluck('permissions.*.permission')
                        ->collapse()
                        ->toArray(),
                    $this->permissions
                        ->pluck('permission')
                        ->toArray()
                )
            ),
        );
    }

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * The relationships that should always be loaded
     *
     * @var array
     */
    protected $with = [
        'roles.permissions',
        'permissions',
        'userSettings',
    ];

    /**
     * Relationship Many:Many
     *
     * Returns the roles associated with the user
     *
     * @return mixed
     */
    public function roles() : mixed
    {
        return $this->belongsToMany(Role::class)
            ->using(RoleUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Relationship Many:Many
     *
     * Returns the permissions associated with the user
     *
     * @return mixed
     */
    public function permissions() : mixed
    {
        return $this->belongsToMany(Permission::class)
            ->using(PermissionUser::class)
            ->withPivot('id')
            ->withTimestamps();
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

    /**
     * Returns true if the user is attached to the specified roles
     *
     * @param string $roles
     *
     * @return bool
     */
    public function hasRoles(string $roles) : bool
    {
        return array_matches($this->roles_list, $roles);
    }

    /**
     * Returns true if the user is attached to the specified permissions
     *
     * @param string $permissions
     *
     * @return bool
     */
    public function hasPermissions(string $permissions) : bool
    {
        return $this->su || array_matches($this->permissions_list, $permissions);
    }

}
