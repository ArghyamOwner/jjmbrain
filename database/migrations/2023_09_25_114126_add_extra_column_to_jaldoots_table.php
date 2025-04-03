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
        Schema::table('jaldoots', function (Blueprint $table) {
            $table->foreignUlid('scheme_id')->nullable()->after('jalshala_school_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jaldoots', function (Blueprint $table) {
            //
        });
    }
};
