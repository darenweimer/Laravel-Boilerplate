<?php

namespace App\Services\Permissions\Models;

use App\Models\Concerns\DateDisplay;
use App\Models\User;
use App\Services\Revisions\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use DateDisplay;
    use HasRevisions;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable
     *
     * @var array
     */
    protected $fillable = [
        'category',
        'permission',
        'description',
    ];

    /**
     * Relationship Many:Many
     *
     * Returns the roles associated with the permission
     *
     * @return mixed
     */
    public function roles(): mixed
    {
        return $this->belongsToMany(Role::class)
            ->using(PermissionRole::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Relationship Many:Many
     *
     * Returns the users associated with the permission
     *
     * @return mixed
     */
    public function users(): mixed
    {
        return $this->belongsToMany(User::class)
            ->using(PermissionUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }
}
