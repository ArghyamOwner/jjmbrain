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
        Schema::create('stock_consumes', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('stock_id')->nullable();
            $table->foreignUlid('user_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_consumes');
    }
};
