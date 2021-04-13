<?php

namespace App\Console\Commands;

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
        {name : The name of the user}
        {email : The email address for the user account}
        {password : The password for the user account}';

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
        User::create([
            'name'     => $this->argument('name'),
            'email'    => $this->argument('email'),
            'password' => Hash::make($this->argument('password')),
        ]);

        $this->info('The user was added to the database.');

        return 0;
    }

}
