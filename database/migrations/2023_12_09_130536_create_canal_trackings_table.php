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
        Schema::create('canal_trackings', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('type')->nullable();
            $table->decimal('size', 10, 2)->nullable();
            $table->string('quality')->nullable();
            $table->json('geojson')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->foreignUlid('approved_by')->nullable();
            $table->timestamp('approved_on')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('canal_trackings');
    }
};
