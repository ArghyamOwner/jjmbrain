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
        Schema::create('jaldoot_attendances', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('jalshala_id')->constrained('jalshalas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('jaldoot_id')->constrained('jaldoots')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamp('attended_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jaldoot_attendances');
    }
};
