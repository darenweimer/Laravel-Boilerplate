<?php

namespace App\Models;

use App\Enums\DataType;
use App\Models\Concerns\DateDisplay;
use App\Models\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use DateDisplay, HasRevisions, SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'setting',
        'data_type',
        'value',
        'expires_at',
    ];

    /**
     * The attributes that should be cast to native types
     *
     * @var array
     */
    protected $casts = [
        'data_type'  => DataType::class,
        'expires_at' => 'timestamp',
    ];

}
