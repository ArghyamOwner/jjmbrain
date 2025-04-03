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
        Schema::create('offices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('name');
            $table->text('address')->nullable();
            $table->string('phone', 12)->nullable();
            $table->string('type')->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('latitude', 11, 8)->nullable();
            $table->text('image')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offices');
    }
};
