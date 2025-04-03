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
        Schema::table('isas', function (Blueprint $table) {
            $table->foreignId('district_id')->nullable()->after('name')->constrained('districts')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('block_id')->nullable()->after('name')->constrained('blocks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('isas', function (Blueprint $table) {
            //
        });
    }
};
