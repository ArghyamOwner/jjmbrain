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
        Schema::create('scheme_pipe_networks', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->text('file')->nullable();
            $table->string('status')->default('active')->nullable();
            $table->string('verification_status')->default('Pending')->nullable();
            $table->foreignUlid('verified_by')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->text('comment')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_pipe_networks');
    }
};
