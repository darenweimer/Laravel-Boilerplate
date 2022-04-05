<?php

namespace App\Models;

use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use DateDisplay, HasRevisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'category',
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
     * Returns the roles associated with the permission
     *
     * @return mixed
     */
    public function roles() : mixed
    {
        return $this->belongsToMany(Role::class)
            ->using(PermissionRole::class)
            ->withPivot('id')
            ->withTimestamps();
    }

}
