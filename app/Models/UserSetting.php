<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use DateDisplay, Revisions, SoftDeletes;

    /**
     * The primary key associated with the table
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * Indicates if the model's primary key is auto-incrementing
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'timezone',
        'notify_exceptions',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
    ];

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * Relationship 1:1
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
