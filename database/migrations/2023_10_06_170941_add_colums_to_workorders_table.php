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
        Schema::table('workorders', function (Blueprint $table) {
            $table->decimal('formal_workorder_amount', 20, 2)->nullable()->after('formal_workorder_date');
            $table->decimal('ts_amount', 20, 2)->nullable()->after('ts_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workorders', function (Blueprint $table) {
            //
        });
    }
};
