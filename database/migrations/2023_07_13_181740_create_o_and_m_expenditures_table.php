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
        Schema::create('o_and_m_expenditures', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('wuc_id')->constrained('wucs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('financial_year_id')->nullable();
            $table->string('month')->nullable();
            $table->decimal('manpower', 20, 2)->nullable();
            $table->decimal('maintenance', 20, 2)->nullable();
            $table->decimal('electricity', 20, 2)->nullable();
            $table->decimal('chemical', 20, 2)->nullable();
            $table->decimal('total_monthly_cost', 20, 2)->nullable();
            $table->text('uc_document')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('o_and_m_expenditures');
    }
};
