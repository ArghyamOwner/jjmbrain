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
        Schema::create('jalshala_statics', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->bigInteger('conducted')->nullable();
            $table->bigInteger('pending')->nullable();
            $table->bigInteger('pwss_mapped')->nullable();
            $table->bigInteger('school_mapped')->nullable();
            $table->bigInteger('jaldoot_mapped')->nullable();
            $table->bigInteger('jaldoot_participated')->nullable();
            $table->string('type')->nullable();
            $table->text('block_name')->nullable();
            $table->foreignId('district_id')->nullable();
            $table->foreignId('block_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalshala_statics');
    }
};
