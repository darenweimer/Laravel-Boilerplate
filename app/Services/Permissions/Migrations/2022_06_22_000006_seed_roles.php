<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Artisan;

return new class extends Migration
{

    /**
     * Runs the migrations
     *
     * @return void
     */
    public function up() : void
    {
        Artisan::call('db:seed --class=RoleSeeder --force');
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down() : void
    {
        // Nothing to reverse
    }

};
