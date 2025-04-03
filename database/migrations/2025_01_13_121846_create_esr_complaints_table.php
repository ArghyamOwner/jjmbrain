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
        Schema::create('esr_complaints', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->string('status')->nullable();
            $table->text('tpi_agency_name')->nullable();
            $table->text('tpi_officer_name')->nullable();
            $table->text('tpi_officer_phone')->nullable();
            $table->text('doc_file')->nullable();
            $table->foreignUlid('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('esr_complaints');
    }
};
