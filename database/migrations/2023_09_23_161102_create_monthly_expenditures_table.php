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
        Schema::create('monthly_expenditures', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->decimal('amount', 20, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->date('expenditure_date')->nullable();
            $table->text('image')->nullable();
            $table->foreignUlid('expenditure_category_id')->constrained('expenditure_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('wuc_id')->constrained('wucs')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_expenditures');
    }
};
