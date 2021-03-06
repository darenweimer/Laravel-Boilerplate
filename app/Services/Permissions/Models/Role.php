<?php

namespace App\Services\Permissions\Models;

use App\Models\Concerns\DateDisplay;
use App\Models\User;
use App\Services\Revisions\Concerns\HasRevisions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
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
        'role',
        'description',
    ];

    /**
     * Relationship Many:Many
     *
     * Returns the permissions associated with the role
     *
     * @return mixed
     */
    public function permissions(): mixed
    {
        return $this->belongsToMany(Permission::class)
            ->using(PermissionRole::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Relationship Many:Many
     *
     * Returns the users associated with the role
     *
     * @return mixed
     */
    public function users(): mixed
    {
        return $this->belongsToMany(User::class)
            ->using(RoleUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }
}
