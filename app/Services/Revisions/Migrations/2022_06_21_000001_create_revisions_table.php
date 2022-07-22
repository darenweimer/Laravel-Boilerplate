<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration
{
    /**
     * Creates the table
     *
     * @param Blueprint $table
     *
     * @return void
     */
    protected function tableCreate(Blueprint $table): void
    {
        $table->id();
        $table->morphs('revisionable');
        $table->foreignId('user_id')->nullable()->index()->constrained();
        $table->string('key');
        $table->text('old_value')->nullable();
        $table->text('new_value')->nullable();
        $table->timestamps();
    }

    /**
     * Runs the migrations
     *
     * @return void
     */
    public function up(): void
    {
        if ($connection = config('revisions.connection')) {
            Schema::connection($connection)
                ->create(
                    'revisions',
                    fn ($table) => $this->tableCreate($table)
                );
        } else {
            Schema::create(
                'revisions',
                fn ($table) => $this->tableCreate($table)
            );
        }
    }

    /**
     * Reverses the migrations
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('revisions');
    }
};
