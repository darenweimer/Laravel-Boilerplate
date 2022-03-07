<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    /**
     * The data to seed
     *
     * @var array
     */
    protected $seeds = [
        [
            'permission'  => 'List Users',
            'description' => 'Can see a list of existing users',
        ],
        [
            'permission'  => 'Show User',
            'description' => 'Can see details about an existing user',
        ],
        [
            'permission'  => 'Create User',
            'description' => 'Can create a new user',
        ],
        [
            'permission'  => 'Edit User',
            'description' => 'Can edit an existing user',
        ],
        [
            'permission'  => 'Delete User',
            'description' => 'Can delete an existing user',
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
            Permission::create($seed);
        }
    }

}
