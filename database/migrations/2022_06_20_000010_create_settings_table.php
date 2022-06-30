<?php

use App\Enums\DataTypes;
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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('setting')->unique();
            $table->enum('data_type', DataTypes::values())->default('string');
            $table->text('value')->nullable();
            $table->timestamp('expires_at')->nullable();
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
        Schema::dropIfExists('settings');
    }

};
