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
        Schema::create('scheme_subdivision', function (Blueprint $table) {
            $table->id();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('subdivision_id')->constrained('subdivisions')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_subdivision');
    }
};
