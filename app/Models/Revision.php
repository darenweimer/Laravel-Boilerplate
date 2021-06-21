<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use DateDisplay;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'revisionable_type',
        'revisionable_id',
        'user_id',
        'key',
        'old_value',
        'new_value',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'revisionable_id' => 'integer',
        'user_id'         => 'integer',
    ];

    /**
     * Relationship 1:1
     *
     * Returns the user associated with the revision
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship 1:1
     *
     * Returns the model associated with the revision
     */
    public function revisionable()
    {
        return $this->morphTo();
    }

}
