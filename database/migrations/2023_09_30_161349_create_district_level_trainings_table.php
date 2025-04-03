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
        Schema::create('district_level_trainings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable()->constrained();
            $table->foreignId('district_id')->nullable();
            $table->foreignUlid('trainer_one_id')->nullable();
            $table->foreignUlid('trainer_two_id')->nullable();
            $table->foreignUlid('trainer_three_id')->nullable();
            $table->datetime('day_one')->nullable();
            $table->datetime('day_two')->nullable();
            $table->text('day_one_image')->nullable();
            $table->text('day_two_image')->nullable();
            $table->integer('total_participant')->default(0);
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district_level_trainings');
    }
};
