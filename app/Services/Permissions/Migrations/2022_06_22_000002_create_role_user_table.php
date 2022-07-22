<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    /**
     * Runs the migrations
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained();
            $table->foreignId('role_id')->index()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
