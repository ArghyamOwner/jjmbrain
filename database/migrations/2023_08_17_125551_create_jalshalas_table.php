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
        Schema::create('jalshalas', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable()->constrained();
            $table->foreignUlid('updated_by')->nullable();
            $table->foreignUlid('trainer_one_id')->nullable();
            $table->foreignUlid('trainer_two_id')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('block_id')->nullable();
            $table->unsignedBigInteger('jalshala_uin')->nullable();
            $table->text('venue')->nullable();
            $table->datetime('day_one')->nullable();
            $table->datetime('day_two')->nullable();
            $table->string('status')->nullable()->default('pending');
            $table->text('day_one_image')->nullable();
            $table->text('day_two_image')->nullable();
            $table->integer('total_student_attended')->default(0);
            $table->integer('total_boys_attended')->default(0);
            $table->integer('total_girls_attended')->default(0);
            $table->integer('total_others_attended')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalshalas');
    }
};
