<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\User;
use Illuminate\Console\Command;
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
        {--group=* : The optional groups to assign to all users}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Adds test users to the database';

    /**
     * Gets all possible test user combinations
     *
     * @return array
     */
    protected function getAllTestUsers() : array
    {
        $testdata = json_decode(
            base64_decode(
                file_get_contents(__DIR__ . '/TestData/users.json')
            )
        );

        $users = [];

        foreach ($testdata->first_name as $first) {
            foreach ($testdata->last_name as $last) {
                $users[] = "{$first} {$last}";
            }
        }

        sort($users);

        return $users;
    }

    /**
     * Gets all existing database users
     *
     * @return array
     */
    protected function getAllExistingUsers() : array
    {
        $existing = User::select([
            'first_name',
            'last_name',
        ])
        ->get();

        $users = [];

        foreach ($existing as $user) {
            $users[] = "{$user->first_name} {$user->last_name}";
        }

        sort($users);

        return $users;
    }

    /**
     * Gets all possible mail server combinations
     *
     * @return array
     */
    protected function getAllTestMailServers() : array
    {
        $testdata = json_decode(
            base64_decode(
                file_get_contents(__DIR__ . '/TestData/mailservers.json')
            )
        );

        $mailServers = [];

        foreach ($testdata->server as $server) {
            foreach ($testdata->domain as $domain) {
                $mailServers[] = "{$server}.{$domain}";
            }
        }

        sort($mailServers);

        return $mailServers;
    }

    /**
     * Gets all attachable database groups
     *
     * @return array
     */
    protected function getAllAttachableGroups() : array
    {
        if ($groups = $this->option('group')) {
            return Group::select('id')
                ->whereIn('group', $groups)
                ->pluck('id')
                ->all();
        }

        return [];
    }

    /**
     * Creates an email address for a test user
     *
     * @param string $first
     * @param string $last
     * @param array $mailServers
     *
     * @return string
     */
    protected function createEmail(string $first, string $last, array $mailServers) : string
    {
        $mailServer = $mailServers[
            rand(0, count($mailServers) - 1)
        ];

        $first = preg_replace('/[^a-zA-Z0-9\.]/', '', $first);
        $last  = preg_replace('/[^a-zA-Z0-9\.]/', '', $last);

        return strtolower("{$first}{$last}@{$mailServer}");
    }

    /**
     * Creates test users
     *
     * @param int $total
     * @param array $users
     *
     * @return void
     */
    protected function createTestUsers(int $total, array $users)
    {
        $password = Hash::make(
            $this->argument('password')
        );

        $mailServers = $this->getAllTestMailServers();

        $groups = $this->getAllAttachableGroups();

        for ($i = 1; $i <= $total; $i++) {
            $user = $users[
                $index = rand(0, count($users) - 1)
            ];

            list($first, $last) = explode(' ', $user);

            array_splice($users, $index, 1);

            $model = User::create([
                'first_name' => $first,
                'last_name'  => $last,
                'email'      => $this->createEmail($first, $last, $mailServers),
                'password'   => $password,
            ]);

            if ($groups) {
                $model->groups()
                    ->attach($groups);
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
        $users = $this->getAllTestUsers();

        $existing = $this->getAllExistingUsers();

        $users = array_diff($users, $existing);

        $total = min(
            $this->argument('total'), count($users)
        );

        if ($total > 0) {
            $this->createTestUsers($total, $users);

            $this->info("{$total} test users were added to the database.");
        } else {
            $this->info("No test users were added to the database: 0 unique remaining.");
        }

        return 0;
    }

}
