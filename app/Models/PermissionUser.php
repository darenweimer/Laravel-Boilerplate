<?php

namespace App\Models;

use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\Revisions;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PermissionUser extends Pivot
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
        'user_id',
        'permission_id',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'user_id'       => 'integer',
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
     * Returns the user associated with the permission user
     *
     * @return mixed
     */
    public function user() : mixed
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship Many:1
     *
     * Returns the permission associated with the permission user
     *
     * @return mixed
     */
    public function permission() : mixed
    {
        return $this->belongsTo(Permission::class);
    }

}
