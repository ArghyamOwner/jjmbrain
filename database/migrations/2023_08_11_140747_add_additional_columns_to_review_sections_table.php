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
        Schema::table('review_sections', function (Blueprint $table) {
            $table->after('points', function() use ($table) {
                $table->string('type')->default('technical');
                $table->text('photo')->nullable();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('review_sections', function (Blueprint $table) {
            $table->dropColumn(['type', 'photo']);
        });
    }
};
