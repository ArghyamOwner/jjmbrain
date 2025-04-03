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
        Schema::table('panchayat_payments', function (Blueprint $table) {
            $table->integer('month')->nullable()->after('payment_date');
            $table->year('year')->nullable()->after('payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('panchayat_payments', function (Blueprint $table) {
            //
        });
    }
};
