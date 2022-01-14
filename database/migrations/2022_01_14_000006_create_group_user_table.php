<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * Runs the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->index();
            $table->foreignId('user_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_user');
    }

};
