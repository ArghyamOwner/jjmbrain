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
        Schema::create('division_bfm_stats', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('division_id')->constrained('divisions')->onDelete('cascade')->onUpdate('cascade');
            $table->date('stats_date')->nullable();
            $table->integer('schemes')->nullable();
            $table->integer('flowmeter_schemes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('division_bfm_stats');
    }
};
