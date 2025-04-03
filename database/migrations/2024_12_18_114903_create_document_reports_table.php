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
        Schema::create('document_reports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('report_number')->nullable();
            $table->string('category')->nullable();
            $table->string('title')->nullable();
            $table->text('file')->nullable();
            $table->foreignUlid('division_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('district_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('block_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('document_reports');
    }
};
