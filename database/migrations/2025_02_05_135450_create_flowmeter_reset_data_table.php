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
        Schema::create('flowmeter_reset_data', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('scheme_flowmeter_detail_id')->nullable()->constrained('scheme_flowmeter_details')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('value', 10, 2)->nullable();
            $table->foreignUlid('created_by')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flowmeter_reset_data');
    }
};
