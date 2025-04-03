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
        Schema::create('scheme_flood_infos', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('user_id')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('water_stagnation_period')->default(0)->nullable();
            $table->text('inundated_infrastructure')->nullable();
            $table->string('severity')->nullable();
            $table->text('partial_damage')->nullable();
            $table->decimal('approx_inundation_height')->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_flood_infos');
    }
};

