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
        Schema::table('districts', function (Blueprint $table) {
            $table->integer('phase2_targeted_jalshala')->after('targeted_jalshala')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('districts', function (Blueprint $table) {
            //
        });
    }
};
