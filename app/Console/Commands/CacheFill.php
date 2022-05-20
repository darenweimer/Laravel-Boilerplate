<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CacheFill extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'cache:fill';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Caches all application data (config, routes, views)';

    /**
     * Executes the console command
     *
     * @return int
     */
    public function handle() : int
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('route:cache');
        Artisan::call('view:cache');

        $this->info('All application data has been cached (config, routes, views).');

        return 0;
    }

}
