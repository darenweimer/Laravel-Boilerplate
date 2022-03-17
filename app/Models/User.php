<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use App\Models\Traits\UserSettings;
use Illuminate\Database\Eloquent\Casts\Attribute;
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
        'google2fa_secret',
        'compromised',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'google2fa_secret'  => 'encrypted',
        'compromised'       => 'boolean',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'google2fa_secret',
        'remember_token',
        'groups',
    ];

    /**
     * The accessors to append to the model's array form
     *
     * @var array
     */
    protected $appends = [
        'google2fa_enabled',
        'groups_list',
        'permissions_list',
    ];

    /**
     * Interacts with the 'google2fa_enabled' attribute
     *
     * @return Attribute
     */
    protected function google2faEnabled() : Attribute
    {
        return Attribute::make(
            get: fn() => (bool) $this->google2fa_secret,
        );
    }

    /**
     * Interacts with the 'groups_list' attribute
     *
     * @return Attribute
     */
    protected function groupsList() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->groups
                ->pluck('group')
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
            get: fn() => $this->groups
                ->pluck('permissions.*.permission')
                ->collapse()
                ->unique()
                ->toArray(),
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
        'groups.permissions',
        'userSettings',
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
        $this->google2fa_secret = app('pragmarx.google2fa')
            ->generateSecretKey();

        return $this;
    }

    /**
     * Disables Google 2fa by clearing the secret key
     *
     * @return static
     */
    public function disableGoogle2fa() : static
    {
        $this->google2fa_secret = null;

        return $this;
    }

    /**
     * Generates the user's Google 2fa QR code inline image
     *
     * @return string|null
     */
    public function getGoogle2faQrCode() : ?string
    {
        if (!$this->google2fa_secret) {
            return null;
        }

        return app('pragmarx.google2fa')
            ->getQRCodeInline(
                config('app.name'), $this->email, $this->google2fa_secret
            );
    }

    /**
     * Returns true if the user is attached to the specified groups
     *
     * @param string $groups
     *
     * @return bool
     */
    public function grouped(string $groups) : bool
    {
        return array_matches($this->groups_list, $groups);
    }

    /**
     * Returns true if the user is attached to the specified permissions
     *
     * @param string $permissions
     *
     * @return bool
     */
    public function permitted(string $permissions) : bool
    {
        return array_matches($this->permissions_list, $permissions);
    }

}
