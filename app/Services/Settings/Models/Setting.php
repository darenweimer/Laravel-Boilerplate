<?php

namespace App\Services\Settings\Models;

use App\Models\Concerns\DateDisplay;
use App\Services\Revisions\Concerns\HasRevisions;
use App\Services\Settings\Enums\DataTypes;
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
        'data_type'  => DataTypes::class,
        'expires_at' => 'timestamp',
    ];

}
