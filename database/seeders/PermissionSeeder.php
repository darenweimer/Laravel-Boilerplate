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
            'category'    => 'User Management',
            'permission'  => 'users:list',
            'description' => 'Can see a list of existing users',
        ],
        [
            'category'    => 'User Management',
            'permission'  => 'users:show',
            'description' => 'Can see details about an existing user',
        ],
        [
            'category'    => 'User Management',
            'permission'  => 'users:create',
            'description' => 'Can create a new user',
        ],
        [
            'category'    => 'User Management',
            'permission'  => 'users:edit',
            'description' => 'Can edit an existing user',
        ],
        [
            'category'    => 'User Management',
            'permission'  => 'users:delete',
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
