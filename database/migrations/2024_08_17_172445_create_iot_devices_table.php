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
        Schema::create('iot_devices', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->nullable()->index();
            $table->text('mqtt_username')->nullable();
            $table->text('mqtt_password')->nullable();
            $table->text('mqtt_device_id')->nullable();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('iot_devices');
    }
};
