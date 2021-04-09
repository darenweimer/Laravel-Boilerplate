<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use DateDisplay, HasFactory, Notifiable, Revisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The model's default values for attributes
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should not be revisioned
     *
     * Attributes in $this->hidden are automatically excluded from revisioning.
     *
     * @var array
     */
    protected $dontRevision = [
        //
    ];

    /**
     * Gets the user's timezone
     *
     * @return string|null
     */
    protected function timezone() : ?string
    {
        // TODO: Replace with proper timezone once user settings are in place
        return null;
    }

}
