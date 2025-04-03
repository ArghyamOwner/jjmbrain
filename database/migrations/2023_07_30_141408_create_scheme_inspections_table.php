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
        Schema::create('scheme_inspections', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->nullable()->constrained();
            $table->foreignUlid('scheme_id')->nullable()->constrained();
            $table->foreignUlid('review_section_id')->nullable()->constrained();
            $table->decimal('section_marks', 10, 2)->default(0);
            $table->decimal('user_marks', 10, 2)->default(0);
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_inspections');
    }
};
