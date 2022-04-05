<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
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
        {--su : Assigns super user status to the user}
        {--role=* : The optional role(s) to assign to the user}
        {--permission=* : The optional permission(s) to assign to the user}';

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
            'su'         => $this->option('su'),
        ]);

        foreach ($this->option('role') as $role) {
            $user->roles()
                ->attach(
                    Role::where('role', $role)
                        ->first()
                );
        }

        foreach ($this->option('permission') as $permission) {
            $user->permissions()
                ->attach(
                    Permission::where('permission', $permission)
                        ->first()
                );
        }

        $this->info('The user was added to the database.');

        return 0;
    }

}
