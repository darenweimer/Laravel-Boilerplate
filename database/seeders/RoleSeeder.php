<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{

    /**
     * The data to seed
     *
     * @var array
     */
    protected $seeds = [
        [
            'role'        => 'Admin',
            'description' => 'System administrators',
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
            Role::create($seed);
        }
    }

}
