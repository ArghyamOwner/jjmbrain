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
        Schema::table('water_reports', function (Blueprint $table) {
            $table->foreignUlid('closed_by')->nullable()->constrained('users')->onDelete('set null');
            $table->date('approved_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('water_reports', function (Blueprint $table) {
            $table->dropForeign(['closed_by']);
            $table->dropColumn(['closed_by', 'approved_date']);
        });
    }
};
