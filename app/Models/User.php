<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use App\Models\Traits\UserSettings;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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
        'google2fa',
        'compromised',
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
        'compromised'       => 'boolean',
    ];

    /*
    |---------------------------------------------------------------------------
    | Attributes
    |---------------------------------------------------------------------------
    */

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'google2fa_enabled',
        'permissions',
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
     * Returns all permissions associated with the user
     *
     * @return array
     */
    public function getPermissionsAttribute() : array
    {
        return $this->groups
            ->pluck('permissions.*.permission')
            ->collapse()
            ->unique()
            ->toArray();
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
        'groups',
        'settings',
    ];

    /**
     * Relationship Many:Many
     *
     * Returns the groups associated with the user
     *
     * @return mixed
     */
    public function groups() : mixed
    {
        return $this->belongsToMany(Group::class)
            ->using(GroupUser::class)
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
     * Enables Google 2fa with a new secret key
     *
     * @return static
     */
    public function enableGoogle2fa() : static
    {
        $this->google2fa = app('pragmarx.google2fa')->generateSecretKey();

        return $this;
    }

    /**
     * Disables Google 2fa by clearing the secret key
     *
     * @return static
     */
    public function disableGoogle2fa() : static
    {
        $this->google2fa = null;

        return $this;
    }

    /**
     * Generates the user's Google 2fa QR code inline image
     *
     * @return string|null
     */
    public function getGoogle2faQrCode() : ?string
    {
        if (!$this->google2fa) {
            return null;
        }

        return app('pragmarx.google2fa')->getQRCodeInline(
            config('app.name'), $this->email, $this->google2fa
        );
    }

    /**
     * Returns true if the user has a permission
     *
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $permission) : bool
    {
        return in_array($permission, $this->permissions);
    }

    /**
     * Returns true if the user has any of a set of permissions
     *
     * @param array $permissions
     *
     * @return bool
     */
    public function hasAnyPermission(array $permissions) : bool
    {
        return count(array_intersect($permissions, $this->permissions)) > 0;
    }

    /**
     * Returns true if the user has all of a set of permissions
     *
     * @param array $permissions
     *
     * @return bool
     */
    public function hasAllPermissions(array $permissions) : bool
    {
        return count(array_intersect($permissions, $this->permissions))
            === count($permissions);
    }

}
