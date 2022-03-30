<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use DateDisplay, Revisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'description',
    ];

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * Relationship Many:Many
     *
     * Returns the permissions associated with the role
     *
     * @return mixed
     */
    public function permissions() : mixed
    {
        return $this->belongsToMany(Permission::class)
            ->using(PermissionRole::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Relationship Many:Many
     *
     * Returns the users associated with the role
     *
     * @return mixed
     */
    public function users() : mixed
    {
        return $this->belongsToMany(User::class)
            ->using(RoleUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }

}
