<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use DateDisplay, Revisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'permission',
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
     * Returns the groups associated with the permission
     *
     * @return mixed
     */
    public function groups() : mixed
    {
        return $this->belongsToMany(Group::class)
            ->using(GroupPermission::class)
            ->withPivot('id')
            ->withTimestamps();
    }

}
