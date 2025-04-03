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
        Schema::create('scheme_binary_data', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');

            $table->string('source')->nullable(); // Yes / No
            $table->date('source_date')->nullable();
            $table->foreignUlid('source_updated_by')->nullable();

            $table->string('tp')->nullable(); // Yes / No
            $table->date('tp_date')->nullable();
            $table->foreignUlid('tp_updated_by')->nullable();

            $table->string('ugr')->nullable(); // Yes / No
            $table->date('ugr_date')->nullable();
            $table->foreignUlid('ugr_updated_by')->nullable();

            $table->string('esr')->nullable(); // Yes / No
            $table->date('esr_date')->nullable();
            $table->foreignUlid('esr_updated_by')->nullable();

            $table->string('pump_house')->nullable(); // Yes / No
            $table->date('pump_house_date')->nullable();
            $table->foreignUlid('pump_house_updated_by')->nullable();

            $table->string('apdcl')->nullable(); // Yes / No
            $table->date('apdcl_date')->nullable();
            $table->foreignUlid('apdcl_updated_by')->nullable();

            $table->string('internal_connection')->nullable(); // Yes / No
            $table->date('internal_connection_date')->nullable();
            $table->foreignUlid('internal_connection_updated_by')->nullable();

            $table->string('gen_set')->nullable(); // Yes / No
            $table->date('gen_set_date')->nullable();
            $table->foreignUlid('gen_set_updated_by')->nullable();

            $table->string('lds')->nullable(); // Yes / No
            $table->date('lds_date')->nullable();
            $table->foreignUlid('lds_updated_by')->nullable();

            $table->string('site_development')->nullable(); // Yes / No
            $table->date('site_development_date')->nullable();
            $table->foreignUlid('site_development_updated_by')->nullable();

            $table->string('boundary_wall')->nullable(); // Yes / No
            $table->date('boundary_wall_date')->nullable();
            $table->foreignUlid('boundary_wall_updated_by')->nullable();

            $table->string('painting')->nullable(); // Yes / No
            $table->date('painting_date')->nullable();
            $table->foreignUlid('painting_updated_by')->nullable();

            $table->string('rwp')->nullable(); // Yes / No
            $table->date('rwp_date')->nullable();
            $table->foreignUlid('rwp_updated_by')->nullable();

            $table->string('cwp')->nullable(); // Yes / No
            $table->date('cwp_date')->nullable();
            $table->foreignUlid('cwp_updated_by')->nullable();

            $table->string('network')->nullable(); // Yes / No
            $table->date('network_date')->nullable();
            $table->foreignUlid('network_updated_by')->nullable();

            $table->string('fhtc')->nullable(); // Yes / No
            $table->date('fhtc_date')->nullable();
            $table->foreignUlid('fhtc_updated_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheme_binary_data');
    }
};
