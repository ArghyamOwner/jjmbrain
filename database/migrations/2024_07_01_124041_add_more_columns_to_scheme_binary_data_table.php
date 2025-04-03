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
            $table->after('panchayat_verified_updated_by', function() use ($table) {
                $table->string('preliminary_workorder')->nullable(); // Yes / No
                $table->date('preliminary_workorder_date')->nullable();
                $table->foreignUlid('preliminary_workorder_updated_by')->nullable();

                $table->string('preliminary_activities')->nullable(); // Yes / No
                $table->date('preliminary_activities_date')->nullable();
                $table->foreignUlid('preliminary_activities_updated_by')->nullable();

                $table->string('formal_workorder')->nullable(); // Yes / No
                $table->date('formal_workorder_date')->nullable();
                $table->foreignUlid('formal_workorder_updated_by')->nullable();
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
