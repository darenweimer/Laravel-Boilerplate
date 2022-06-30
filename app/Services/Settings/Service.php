<?php

namespace App\Services\Settings;

use Illuminate\Support\ServiceProvider;

class Service extends ServiceProvider
{

    /**
     * Registers any application services
     *
     * @return void
     */
    public function register() : void
    {
        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        require __DIR__ . '/helpers.php';
    }

    /**
     * Bootstraps any application services
     *
     * @return void
     */
    public function boot() : void
    {
        //
    }

}
