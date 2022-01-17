<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{

    /**
     * The data to seed
     *
     * @var array
     */
    protected $seeds = [
        [
            'group'      => 'Admin',
            'permission' => 'List Users',
        ],
        [
            'group'      => 'Admin',
            'permission' => 'Show User',
        ],
        [
            'group'      => 'Admin',
            'permission' => 'Create User',
        ],
        [
            'group'      => 'Admin',
            'permission' => 'Edit User',
        ],
        [
            'group'      => 'Admin',
            'permission' => 'Delete User',
        ],
    ];

    /**
     * Runs the database seeds
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->seeds as $seed) {
            Group::where('group', $seed['group'])
                ->first()
                ->permissions()
                ->attach(
                    Permission::where('permission', $seed['permission'])
                        ->first()
                );
        }
    }

}
