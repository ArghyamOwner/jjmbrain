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
        Schema::create('general_grievances', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('division_id')->constrained('divisions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('district_id')->constrained('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('block_id')->nullable();
            $table->foreignUlid('scheme_id')->nullable();
            $table->string('reference_no')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->foreignUlid('checked_by')->nullable();
            $table->timestamp('checked_on')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_grievances');
    }
};
