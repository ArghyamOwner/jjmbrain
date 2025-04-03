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
            $table->string('funding_agency')->nullable()->after('scheme_status')->default('JJM');
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
