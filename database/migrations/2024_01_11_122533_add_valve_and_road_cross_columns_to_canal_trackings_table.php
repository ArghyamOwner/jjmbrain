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
        Schema::table('canal_trackings', function (Blueprint $table) {
            $table->json('valve')->nullable()->after('geojson');
            $table->json('road_cross')->nullable()->after('geojson');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('canal_trackings', function (Blueprint $table) {
            //
        });
    }
};
