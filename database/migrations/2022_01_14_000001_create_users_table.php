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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('google2fa_secret')->nullable();
            $table->rememberToken();
            $table->boolean('su')->default(false);
            $table->boolean('compromised')->default(false);
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
        Schema::dropIfExists('users');
    }

};
