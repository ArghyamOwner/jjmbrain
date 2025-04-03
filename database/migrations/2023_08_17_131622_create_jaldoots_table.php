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
        Schema::create('jaldoots', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('jalshala_school_id')->nullable();
            $table->bigInteger('jaldoot_uin')->nullable(); // JalshalaID + 3 digit ID unique system ID
            $table->string('student_name')->nullable(); 
            $table->string('student_phone', 10)->nullable(); 
            $table->string('gender', 10)->nullable();  // male / female / other
            $table->tinyInteger('age')->nullable(); 
            $table->string('class')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaldoots');
    }
};
