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
    public function up()
    {
        Artisan::call('db:seed --class=GroupSeeder --force');
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down()
    {
        // Nothing to reverse
    }

};
