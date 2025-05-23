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
            $table->string('compressor_capacity_unit')->nullable()->after('compressor_capacity');
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
