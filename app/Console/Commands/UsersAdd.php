<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Permissions\Models\Permission;
use App\Services\Permissions\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UsersAdd extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'users:add
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
     * Retrieves all existing selected roles
     *
     * @return array
     */
    protected function getAttachableRoles() : array
    {
        if ($roles = $this->option('role')) {
            return Role::select('id')
                ->whereIn('role', $roles)
                ->pluck('id')
                ->all();
        }

        return [];
    }

    /**
     * Retrieves all existing selected permissions
     *
     * @return array
     */
    protected function getAttachablePermissions() : array
    {
        if ($permissions = $this->option('permission')) {
            return Permission::select('id')
                ->whereIn('permission', $permissions)
                ->pluck('id')
                ->all();
        }

        return [];
    }

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

        if ($roles = $this->getAttachableRoles()) {
            $user->roles()
                ->attach($roles);
        }

        if ($permissions = $this->getAttachablePermissions()) {
            $user->permissions()
                ->attach($permissions);
        }

        $this->info('The user was added to the database.');

        return 0;
    }

}
