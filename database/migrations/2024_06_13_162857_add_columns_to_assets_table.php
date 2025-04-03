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
        Schema::table('assets', function (Blueprint $table) {
            $table->text('additional_details')->nullable()->after('serial_number');
            $table->decimal('capacity', 13, 2)->nullable()->after('serial_number');
            $table->decimal('size', 13, 2)->nullable()->after('serial_number');
            $table->string('certification')->nullable()->after('serial_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('assets', function (Blueprint $table) {
            //
        });
    }
};
