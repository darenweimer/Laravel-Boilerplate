<?php

namespace App\Models\Concerns;

use App\Models\Permission;
use App\Models\PermissionUser;
use App\Models\Role;
use App\Models\RoleUser;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasPermissions
{

    /**
     * Interacts with the 'roles_list' attribute
     *
     * @return Attribute
     */
    protected function rolesList() : Attribute
    {
        return Attribute::make(
            get: fn() => $this->roles
                ->pluck('role')
                ->toArray(),
        );
    }

    /**
     * Interacts with the 'permissions_list' attribute
     *
     * @return Attribute
     */
    protected function permissionsList() : Attribute
    {
        return Attribute::make(
            get: fn() => array_unique(
                array_merge(
                    $this->roles
                        ->pluck('permissions.*.permission')
                        ->collapse()
                        ->toArray(),
                    $this->permissions
                        ->pluck('permission')
                        ->toArray()
                )
            ),
        );
    }

    /**
     * Scopes a query to include permissions-related relationships
     *
     * @param mixed $query
     *
     * @return mixed
     */
    public function scopeGetWithPermissions(mixed $query) : mixed
    {
        return $query
            ->with([
                'roles.permissions',
                'permissions',
            ])
            ->get()
            ->makeHidden([
                'roles',
                'permissions',
            ])
            ->append([
                'roles_list',
                'permissions_list',
            ]);
    }

    /**
     * Scopes a model to include permissions-related relationships
     *
     * @return static
     */
    public function withPermissions() : static
    {
        return $this
            ->loadMissing([
                'roles.permissions',
                'permissions',
            ])
            ->makeHidden([
                'roles',
                'permissions',
            ])
            ->append([
                'roles_list',
                'permissions_list',
            ]);
    }

    /**
     * Relationship Many:Many
     *
     * Returns the roles associated with the user
     *
     * @return mixed
     */
    public function roles() : mixed
    {
        return $this->belongsToMany(Role::class)
            ->using(RoleUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Relationship Many:Many
     *
     * Returns the permissions associated with the user
     *
     * @return mixed
     */
    public function permissions() : mixed
    {
        return $this->belongsToMany(Permission::class)
            ->using(PermissionUser::class)
            ->withPivot('id')
            ->withTimestamps();
    }

    /**
     * Grants the specified roles to the user
     *
     * @param string|array $roles
     *
     * @return static
     */
    public function grantRoles(string|array $roles) : static
    {
        $grantable = Role::whereIn(
            'role', is_array($roles) ? $roles : [$roles]
        )
        ->get();

        if ($grantable->isNotEmpty()) {
            $this->roles()
                ->syncWithoutDetaching($grantable);
        }

        return $this;
    }

    /**
     * Revokes the specified roles from the user
     *
     * @param string|array $roles
     *
     * @return static
     */
    public function revokeRoles(string|array $roles) : static
    {
        $revokable = Role::whereIn(
            'role', is_array($roles) ? $roles : [$roles]
        )
        ->get();

        if ($revokable->isNotEmpty()) {
            $this->roles()
                ->detach($revokable);
        }

        return $this;
    }

    /**
     * Returns true if the user is attached to a specified role
     *
     * @param string $role
     *
     * @return bool
     */
    public function hasRole(string $role) : bool
    {
        return in_array($role, $this->roles_list);
    }

    /**
     * Returns true if the user is attached to the specified roles
     *
     * @param string $roles
     *
     * @return bool
     */
    public function hasRoles(string $roles) : bool
    {
        return array_matches($this->roles_list, $roles);
    }

    /**
     * Grants the specified permissions to the user
     *
     * @param string|array $permissions
     *
     * @return static
     */
    public function grantPermissions(string|array $permissions) : static
    {
        $grantable = Permission::whereIn(
            'permission', is_array($permissions) ? $permissions : [$permissions]
        )
        ->get();

        if ($grantable->isNotEmpty()) {
            $this->permissions()
                ->syncWithoutDetaching($grantable);
        }

        return $this;
    }

    /**
     * Revokes the specified permissions from the user
     *
     * @param string|array $permissions
     *
     * @return static
     */
    public function revokePermissions(string|array $permissions) : static
    {
        $revokable = Permission::whereIn(
            'permission', is_array($permissions) ? $permissions : [$permissions]
        )
        ->get();

        if ($revokable->isNotEmpty()) {
            $this->permissions()
                ->detach($revokable);
        }

        return $this;
    }

    /**
     * Returns true if the user is attached to a specified permission
     *
     * @param string $permission
     *
     * @return bool
     */
    public function hasPermission(string $permission) : bool
    {
        return $this->su || in_array($permission, $this->permissions_list);
    }

    /**
     * Returns true if the user is attached to the specified permissions
     *
     * @param string $permissions
     *
     * @return bool
     */
    public function hasPermissions(string $permissions) : bool
    {
        return $this->su || array_matches(
            $this->permissions_list, $permissions
        );
    }

}
