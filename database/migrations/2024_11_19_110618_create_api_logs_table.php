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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->string('method');
            $table->string('url');
            $table->string('route_name')->nullable();
            $table->unsignedSmallInteger('status_code');
            $table->ipAddress('ip_address')->nullable();
            $table->integer('response_time')->nullable();
            $table->unsignedBigInteger('response_size')->nullable();
            $table->foreignUlid('user_id')->nullable()->constrained();
            $table->string('location')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('platform')->nullable();
            $table->string('platform_version')->nullable();
            $table->string('browser')->nullable();
            $table->string('browser_version')->nullable();
            $table->string('auth_type')->nullable();
            $table->json('error_details')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
