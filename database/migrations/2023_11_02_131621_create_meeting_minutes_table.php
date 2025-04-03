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
        Schema::create('meeting_minutes', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->text('meeting_name');
            $table->timestamp('meeting_date')->nullable();
            $table->text('description')->nullable();
            $table->foreignUlid('user_id')->nullable();
            $table->string('user_group')->nullable();
            $table->text('link')->nullable();
            $table->string('venue')->nullable();
            $table->text('pdf')->nullable();
            $table->text('minutes')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->foreignUlid('meeting_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meeting_minutes');
    }
};
