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
        Schema::create('water_reports', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('user_id')->constrained();
            $table->foreignUlid('approved_by')->nullable()->constrained('users')->onDelete('set null');
            $table->string('status')->nullable();
            $table->text('reasons_disruption')->nullable();
            $table->text('specific_reasons')->nullable();
            $table->integer('days')->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('resolved')->default(false);
            $table->date('resolved_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('water_reports');
    }
};
