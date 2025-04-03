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
        Schema::create('jalshala_schools', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('jalshala_id')->nullable();
            $table->text('school_name')->nullable();
            $table->string('school_code', 11)->unqiue()->nullable(); // UDISCE code
            $table->string('teacher_name')->nullable();  
            $table->string('phone_number', 10)->nullable();  
            $table->integer('student_applied')->default(0);  
            $table->text('link')->nullable();  
            $table->timestamp('blocked_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jalshala_schools');
    }
};
