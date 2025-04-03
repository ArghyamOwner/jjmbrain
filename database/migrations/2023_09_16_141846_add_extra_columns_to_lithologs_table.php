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
        Schema::table('lithologs', function (Blueprint $table) {
            $table->string('verification_status')->nullable()->after('checked_by');
            $table->foreignUlid('verified_by')->nullable()->after('checked_by');
            $table->foreignUlid('advised_by')->nullable()->after('checked_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lithologs', function (Blueprint $table) {
            //
        });
    }
};
