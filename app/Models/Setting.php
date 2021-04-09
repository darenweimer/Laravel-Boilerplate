<?php

namespace App\Models;

use App\Models\Traits\DateDisplay;
use App\Models\Traits\Revisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use DateDisplay, Revisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'setting',
        'value',
        'expires_at',
    ];

    /**
     * The attributes that should be hidden for arrays
     *
     * @var array
     */
    protected $hidden = [
        //
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'timestamp',
    ];

    /**
     * The model's default values for attributes
     *
     * @var array
     */
    protected $attributes = [
        //
    ];

    /**
     * The attributes that should not be revisioned
     *
     * Attributes in $this->hidden are automatically excluded from revisioning.
     *
     * @var array
     */
    protected $dontRevision = [
        //
    ];

}
