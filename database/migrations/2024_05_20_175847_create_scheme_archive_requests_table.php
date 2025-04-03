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
        Schema::create('scheme_archive_requests', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->nullable();
            $table->string('scheme_name')->nullable();
            $table->string('smt_id')->nullable();
            $table->string('imis_id')->nullable();
            $table->foreignUlid('division_id')->nullable();
            $table->text('reason')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->text('comment')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->foreignUlid('checked_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_archive_requests');
    }
};
