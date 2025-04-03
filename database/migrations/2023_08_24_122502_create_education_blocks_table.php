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
        Schema::create('education_blocks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('district_id')->nullable();
            $table->string('block_name');
            $table->string('block_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_blocks');
    }
};
