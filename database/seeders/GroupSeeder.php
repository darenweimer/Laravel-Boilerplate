<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{

    /**
     * The data to seed
     *
     * @var array
     */
    protected $seeds = [
        [
            'group'       => 'Admin',
            'description' => 'System administrators',
        ],
        [
            'group'       => 'Guest',
            'description' => 'Users without authentication',
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
            Group::create($seed);
        }
    }

}
