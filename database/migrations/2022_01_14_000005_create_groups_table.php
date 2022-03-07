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
    public function up() : void
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('group')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('groups');
    }

};
