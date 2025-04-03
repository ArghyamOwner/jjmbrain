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
        Schema::table('scheme_flowmeter_details', function (Blueprint $table) {
            $table->boolean('reset_point')->default(false)->after('created_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheme_flowmeter_details', function (Blueprint $table) {
            //
        });
    }
};
