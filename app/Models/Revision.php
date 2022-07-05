<?php

namespace App\Models;

use App\Models\Concerns\DateDisplay;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Revision extends Model
{
    use DateDisplay, Prunable;

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
     * Relationship Many:1
     *
     * Returns the model associated with the revision
     *
     * @return mixed
     */
    public function revisionable() : mixed
    {
        return $this->morphTo();
    }

    /**
     * Relationship Many:1
     *
     * Returns the user associated with the revision
     *
     * @return mixed
     */
    public function user() : mixed
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Gets the current connection name for the model
     *
     * @return string|null
     */
    public function getConnectionName() : ?string
    {
        return config('revisions.connection');
    }

    /**
     * Gets the prunable model query
     *
     * @return mixed
     */
    public function prunable() : mixed
    {
        if (($retention = config('revisions.retention')) && ($retention > 0)) {
            return static::where(
                'created_at', '<', now()->subDay($retention)->startOfDay()
            );
        }

        return static::whereRaw('0');
    }

}
