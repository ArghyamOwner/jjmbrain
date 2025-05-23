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
        Schema::create('o_and_m_collections', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('wuc_id')->constrained('wucs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('financial_year_id')->nullable();
            $table->string('month')->nullable();
            $table->decimal('household', 20, 2)->nullable();
            $table->decimal('total', 20, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_and_m_collections');
    }
};
