<?php

namespace App\Models;

use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\Revisions;
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
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'expires_at' => 'timestamp',
    ];

}
