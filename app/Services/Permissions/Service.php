<?php

namespace App\Services\Permissions;

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
