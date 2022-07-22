<?php

namespace App\Services\Revisions;

use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{
    /**
     * Registers any application services
     *
     * @return void
     */
    public function register(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->mergeConfigFrom(__DIR__ . '/Config/revisions.php', 'revisions');
    }

    /**
     * Bootstraps any application services
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
