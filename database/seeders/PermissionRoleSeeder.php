<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleSeeder extends Seeder
{

    /**
     * The data to seed
     *
     * @var array
     */
    protected $seeds = [
        [
            'role'       => 'Admin',
            'permission' => 'users:list',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'users:show',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'users:create',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'users:edit',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'users:delete',
        ],
    ];

    /**
     * Runs the database seeds
     *
     * @return void
     */
    public function run() : void
    {
        foreach ($this->seeds as $seed) {
            Role::where('role', $seed['role'])
                ->first()
                ->permissions()
                ->attach(
                    Permission::where('permission', $seed['permission'])
                        ->first()
                );
        }
    }

}
