<?php

namespace App\Models;

use App\Enums\NotifyOptions;
use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use DateDisplay, HasRevisions, SoftDeletes;

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
        'user_id'           => 'integer',
        'notify_exceptions' => NotifyOptions::class,
    ];

    /*
    |---------------------------------------------------------------------------
    | Relationships
    |---------------------------------------------------------------------------
    */

    /**
     * Relationship 1:1
     *
     * Returns the user associated with the user settings
     *
     * @return mixed
     */
    public function user() : mixed
    {
        return $this->belongsTo(User::class);
    }

}
