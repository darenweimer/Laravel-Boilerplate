<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CacheFlush extends Command
{

    /**
     * The name and signature of the console command
     *
     * @var string
     */
    protected $signature = 'cache:flush';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Flushes all cached application data (config, routes, storage, views)';

    /**
     * Executes the console command
     *
     * @return int
     */
    public function handle() : int
    {
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        $this->info('All cached application data has been flushed (config, routes, storage, views).');

        return 0;
    }

}
