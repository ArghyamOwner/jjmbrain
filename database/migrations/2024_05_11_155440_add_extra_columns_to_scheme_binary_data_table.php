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
        Schema::table('scheme_binary_data', function (Blueprint $table) {
            $table->after('fhtc_updated_by', function() use ($table) {

                $table->string('trial_run')->nullable(); // Yes / No
                $table->date('trial_run_date')->nullable();
                $table->foreignUlid('trial_run_updated_by')->nullable();

                $table->string('work_completion')->nullable(); // Yes / No
                $table->date('work_completion_date')->nullable();
                $table->foreignUlid('work_completion_updated_by')->nullable();

                $table->string('scheme_handover')->nullable(); // Yes / No
                $table->date('scheme_handover_date')->nullable();
                $table->foreignUlid('scheme_handover_updated_by')->nullable();

                $table->string('panchayat_verified')->nullable(); // Yes / No
                $table->date('panchayat_verified_date')->nullable();
                $table->foreignUlid('panchayat_verified_updated_by')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheme_binary_data', function (Blueprint $table) {
            //
        });
    }
};
