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
        Schema::create('wuc_documents', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title')->nullable();
            $table->foreignUlid('wuc_id')->nullable();
            $table->string('type')->nullable();
            $table->text('document')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wuc_documents');
    }
};
