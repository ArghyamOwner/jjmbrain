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
        Schema::table('monthly_expenditures', function (Blueprint $table) {
            $table->foreignUlid('financial_year_id')->nullable()->after('expenditure_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('monthly_expenditures', function (Blueprint $table) {
            //
        });
    }
};
