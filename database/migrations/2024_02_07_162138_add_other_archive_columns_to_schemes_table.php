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
            $table->foreignUlid('archived_by')->nullable()->after('is_archived');
            $table->timestamp('archived_on')->nullable()->after('is_archived');
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
