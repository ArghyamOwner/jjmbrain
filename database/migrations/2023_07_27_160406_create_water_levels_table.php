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
        Schema::create('water_levels', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('litholog_id')->constrained('lithologs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('pattern_id')->nullable()->constrained();
            $table->integer('start')->nullable();
            $table->integer('end')->nullable();
            $table->string('type')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_levels');
    }
};
