<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Registers any application services
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstraps any application services
     *
     * @return void
     */
    public function boot()
    {
        $filename = app_path(
            '~' . ($this->app->runningInConsole() ? 'console' : 'web') . '.php'
        );

        if (is_file($filename)) {
            include $filename;
        }
    }

}
