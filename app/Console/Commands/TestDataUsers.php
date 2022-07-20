<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Services\Permissions\Models\Permission;
use App\Services\Permissions\Models\Role;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class TestDataUsers extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'testdata:users
        {total : The number of test users to create}
        {password=password : The optional password to use for all users}
        {--su : Assigns super user status to all users}
        {--role=* : The optional role(s) to assign to all users}
        {--permission=* : The optional permission(s) to assign to all users}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Adds test users to the database';

    /**
     * Retrieves all existing users by email
     *
     * @return array
     */
    protected function getExistingUsers() : array
    {
        return DB::table('users')
            ->select('email')
            ->get()
            ->pluck('email')
            ->all();
    }

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
     * Generates unique user accounts
     *
     * @param int $count
     * @param array $existing
     *
     * @return array
     */
    protected function generateUsers(int $count, array $existing) : array
    {
        $users = [];

        $faker = fake();

        $password = Hash::make(
            $this->argument('password')
        );

        $su = $this->option('su');

        while (count($users) < $count) {
            try {
                $user = [
                    'first_name' => $faker->firstName(),
                    'last_name'  => $faker->lastName(),
                    'email'      => $faker->unique()->safeEmail(),
                    'password'   => $password,
                    'su'         => $su,
                ];

                if (!in_array($user['email'], $existing)) {
                    $users[] = $user;
                }
            } catch (Exception $e) {
                break;
            }
        }

        return $users;
    }

    /**
     * Inserts user accounts in the database
     *
     * @param array $users
     *
     * @return void
     */
    protected function insertUsers(array $users) : void
    {
        $roles = $this->getAttachableRoles();

        $permissions = $this->getAttachablePermissions();

        $total = count($users);

        for ($i = 1; $i <= $total; $i++) {
            $user = User::create($users[$i - 1]);

            if ($roles) {
                $user->roles()
                    ->attach($roles);
            }

            if ($permissions) {
                $user->permissions()
                    ->attach($permissions);
            }

            $this->comment("Added user {$i} of {$total}");
        }
    }

    /**
     * Executes the console command
     *
     * @return int
     */
    public function handle() : int
    {
        $users = $this->generateUsers(
            $total = $this->argument('total'), $this->getExistingUsers()
        );

        if (($unique = count($users)) < $total) {
            $this->error(
                "No test users were added to the database: {$unique} unique available."
            );
        } else {
            $this->insertUsers($users);

            $this->info("{$total} test users were added to the database.");
        }

        return 0;
    }

}
