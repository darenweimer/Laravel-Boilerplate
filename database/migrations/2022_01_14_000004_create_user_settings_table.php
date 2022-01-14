<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    /**
     * The options for notifications
     *
     * @const array
     */
    protected const NOTIFY_OPTIONS = [
        'none',
        'email',
        'text',
        'both',
    ];

    /**
     * Runs the migrations
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->foreignId('user_id')->primary();
            $table->string('timezone')->nullable();
            $table->enum('notify_exceptions', static::NOTIFY_OPTIONS)->default('none');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_settings');
    }

};
