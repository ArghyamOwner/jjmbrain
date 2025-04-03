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
        Schema::create('lithologs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('well_id')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('drilling_type')->nullable();
            $table->string('driller_name')->nullable();
            $table->string('driller_phone', 14)->nullable();
            $table->string('drill_vehicle_number')->nullable();
            $table->decimal('hole_diameter', 10, 2)->nullable();
            $table->decimal('casing_size', 10, 2)->nullable();
            $table->decimal('compressor_capacity', 10, 2)->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->decimal('compressor_pressure', 10, 2)->nullable();
            $table->decimal('static_water', 10, 2)->nullable();
            $table->integer('duration_pump')->nullable();
            $table->integer('discharge')->nullable();
            $table->integer('drawdown')->nullable();
            $table->string('status')->nullable();
            $table->text('advisory')->nullable();
            $table->foreignUlid('checked_by')->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lithologs');
    }
};
