<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UserAdd extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'user:add
        {first : The first name of the user}
        {last : The last name of the user}
        {email : The email address for the user account}
        {password : The password for the user account}
        {--group=* : The optional groups to assign to the user}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Adds a new user to the database';

    /**
     * Executes the console command
     *
     * @return int
     */
    public function handle() : int
    {
        $user = User::create([
            'first_name' => $this->argument('first'),
            'last_name'  => $this->argument('last'),
            'email'      => $this->argument('email'),
            'password'   => Hash::make(
                $this->argument('password')
            ),
        ]);

        foreach ($this->option('group') as $group) {
            $user->groups()
                ->attach(
                    Group::where('group', $group)->first()
                );
        }

        $this->info('The user was added to the database.');

        return 0;
    }

}
