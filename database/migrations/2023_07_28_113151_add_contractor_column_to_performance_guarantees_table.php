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
        Schema::table('performance_guarantees', function (Blueprint $table) {
            $table->foreignUlid('contractor_id')->nullable()->after('user_id');
            $table->string('contractor_name')->nullable()->after('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('performance_guarantees', function (Blueprint $table) {
            //
        });
    }
};
