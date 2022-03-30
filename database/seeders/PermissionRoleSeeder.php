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
            'permission' => 'List Users',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'Show User',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'Create User',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'Edit User',
        ],
        [
            'role'       => 'Admin',
            'permission' => 'Delete User',
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
