<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UserExpire extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'user:expire
        {--id=* : The optional user id(s) to expire}';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Expires user sessions';

    /**
     * Executes the console command
     *
     * @return int
     */
    public function handle() : int
    {
        $query = DB::table('sessions');

        if ($users = $this->option('id')) {
            $query->whereIn('user_id', $users);
        }

        $query->delete();

        $this->info('All selected user sessions have been expired.');

        return 0;
    }

}
