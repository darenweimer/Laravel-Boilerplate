<?php

namespace App\Models;

use App\Models\Concerns\DateDisplay;
use App\Services\Revisions\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RoleUser extends Pivot
{
    use DateDisplay, HasRevisions;

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
        'role_id',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'role_id' => 'integer',
    ];

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * Relationship Many:1
     *
     * Returns the user associated with the role user
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
     * Returns the role associated with the role user
     *
     * @return mixed
     */
    public function role() : mixed
    {
        return $this->belongsTo(Role::class);
    }

}
