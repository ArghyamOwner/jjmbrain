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
            // $table->index('division_id');
            // $table->index('district_id');
            $table->index('block_id');
            $table->index('panchayat');
            // $table->index('work_status');
            $table->index('operating_status');
            // $table->index('imis_id');
            // $table->index('old_scheme_id');
            $table->fullText('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schemes', function (Blueprint $table) {
            // $table->dropIndex('division_id');
            // $table->dropIndex('district_id');
            $table->dropIndex('block_id');
            $table->dropIndex('panchayat_id');
            // $table->dropIndex('work_status');
            $table->dropIndex('operating_status');
            // $table->dropIndex('imis_id');
            // $table->dropIndex('old_scheme_id');
            $table->dropIndex('name');
        });
    }
};
