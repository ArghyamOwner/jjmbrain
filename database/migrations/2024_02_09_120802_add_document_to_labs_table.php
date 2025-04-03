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
        Schema::table('labs', function (Blueprint $table) {
            $table->date('nabl_certification_expiry')->after('nabl_certification')->nullable();
            $table->text('document')->after('nabl_certification_expiry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('labs', function (Blueprint $table) {
            //
        });
    }
};
