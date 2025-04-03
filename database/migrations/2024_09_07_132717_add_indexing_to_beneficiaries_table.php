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
        Schema::table('beneficiaries', function (Blueprint $table) {
            $table->index('beneficiary_voter_number');
            $table->index('beneficiary_aadhaar');
            $table->index('beneficiary_phone');
            $table->index('user_id');
            $table->index('beneficiary_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('beneficiaries', function (Blueprint $table) {
            //
        });
    }
};
