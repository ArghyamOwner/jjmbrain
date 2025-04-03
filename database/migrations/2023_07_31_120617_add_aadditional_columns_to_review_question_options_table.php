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
        Schema::table('review_question_options', function (Blueprint $table) {
            $table->decimal('marks', 10, 2)->after('option')->default(0);
        });
    }
    
    public function down(): void
    {
        Schema::table('review_question_options', function (Blueprint $table) {
            $table->dropColumn('marks');
        });
    }
};
