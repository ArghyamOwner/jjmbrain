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
        Schema::create('division_stats', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('division_id')->constrained('divisions')->onDelete('cascade')->onUpdate('cascade');
            $table->string('key')->nullable();
            $table->string('name')->nullable();
            $table->decimal('value', 10, 2)->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_stats');
    }
};
