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
        Schema::table('jalshalas', function (Blueprint $table) {
            $table->foreignUlid('education_block_id')->nullable()->after('block_id')->constrained('education_blocks')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jalshalas', function (Blueprint $table) {
            //
        });
    }
};
