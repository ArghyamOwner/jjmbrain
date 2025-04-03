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
        Schema::table('jalshala_schools', function (Blueprint $table) {
            $table->foreignUlid('school_id')->nullable()->after('jalshala_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jalshala_schools', function (Blueprint $table) {
            //
        });
    }
};
