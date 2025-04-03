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
        Schema::table('scheme_inspections', function (Blueprint $table) {
            $table->after('user_marks', function() use ($table) {
                $table->text('photo')->nullable();
                $table->text('comment')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scheme_inspections', function (Blueprint $table) {
            $table->dropColumn(['photo', 'comments']);
        });
    }
};
