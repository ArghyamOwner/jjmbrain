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
        Schema::create('schools', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('district_id')->nullable();
            $table->foreignUlid('education_block_id')->nullable();
            $table->string('school_name');
            $table->string('school_code')->nullable();
            $table->string('category')->nullable();
            $table->string('location')->nullable();
            $table->string('drink_water')->nullable();
            $table->string('hand_pump')->nullable();
            $table->string('electricity')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
