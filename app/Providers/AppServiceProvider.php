<?php

namespace App\Providers;

use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Registers grammar macros for database migrations
     *
     * @return void
     */
    protected function registerDatabaseGrammars() : void
    {
        Grammar::macro('typeNumeric', fn() => 'numeric');
    }

    /**
     * Registers any application services
     *
     * @return void
     */
    public function register() : void
    {
        //
    }

    /**
     * Bootstraps any application services
     *
     * @return void
     */
    public function boot() : void
    {
        $this->registerDatabaseGrammars();

        $filename = app_path(
            '~' . ($this->app->runningInConsole() ? 'console' : 'web') . '.php'
        );

        if (is_file($filename)) {
            include $filename;
        }
    }

}
