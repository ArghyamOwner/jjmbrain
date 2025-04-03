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
        Schema::create('field_test_kits', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('division_id')->nullable();
            $table->foreignUlid('district_id')->nullable();
            $table->foreignUlid('block_id')->nullable();
            $table->foreignUlid('panchayat_id')->nullable();
            $table->foreignUlid('village_id')->nullable();
            $table->string('assigned_person_name')->nullable();
            $table->string('assigned_person_phone', 10)->nullable();
            $table->string('brand_name')->nullable();
            $table->date('issue_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('field_test_kits');
    }
};
