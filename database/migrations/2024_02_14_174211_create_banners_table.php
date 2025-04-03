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
        Schema::create('banners', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('title')->nullable();
            $table->string('app_name')->nullable();
            $table->text('image')->nullable();
            $table->text('link')->nullable();
            $table->string('status')->default('Active')->nullable();
            $table->foreignUlid('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
