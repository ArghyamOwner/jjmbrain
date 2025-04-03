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
        Schema::table('schemes', function (Blueprint $table) {
            $table->index('name');
            $table->index('old_scheme_id');
            $table->index('imis_id');
            $table->index('division_id');
            $table->index('district_id');
            $table->index('work_status');
            $table->index('latitude');
            $table->index('longitude');
            $table->index('is_archived');
            $table->index('tpi_progress');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            //
        });
    }
};
