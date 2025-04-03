<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jal_addas', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable();
            $table->foreignUlid('trainer_one_id')->nullable();
            $table->foreignUlid('trainer_two_id')->nullable();
            $table->text('venue')->nullable();
            $table->text('attendee')->nullable();
            $table->datetime('day_one')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->text('one_image')->nullable();
            $table->text('two_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jal_addas');
    }
};
