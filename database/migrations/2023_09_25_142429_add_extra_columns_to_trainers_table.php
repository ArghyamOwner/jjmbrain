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
        Schema::table('trainers', function (Blueprint $table) {
            $table->foreignUlid('education_block_id')->nullable()->after('district_id');
            $table->after('phone_number', function() use ($table) {
                $table->string('organisation')->nullable();
                $table->string('bank_name')->nullable();
                $table->string('account_number')->nullable();
                $table->string('ifsc_code')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainers', function (Blueprint $table) {
            //
        });
    }
};
