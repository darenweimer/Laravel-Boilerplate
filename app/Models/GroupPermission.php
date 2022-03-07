<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Database\Eloquent\Relations\Pivot;

class GroupPermission extends Pivot
{
    use DateDisplay, Revisions;

    /**
     * Indicates if the model's primary key is auto-incrementing
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'group_id',
        'permission_id',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'group_id'      => 'integer',
        'permission_id' => 'integer',
    ];

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * Relationship Many:1
     *
     * Returns the group associated with the group permission
     *
     * @return mixed
     */
    public function group() : mixed
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Relationship Many:1
     *
     * Returns the permission associated with the group permission
     *
     * @return mixed
     */
    public function permission() : mixed
    {
        return $this->belongsTo(Permission::class);
    }

}
