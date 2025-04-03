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
        Schema::create('panchayat_payments', function (Blueprint $table) {
            $table->ulid('id')->primary();
            $table->foreignUlid('scheme_id')->constrained('schemes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('panchayat_id')->constrained('panchayats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUlid('wuc_id')->nullable()->constrained('wucs')->onDelete('cascade')->onUpdate('cascade');
            $table->date('wuc_ack')->nullable();
            $table->foreignUlid('jalmitra_id')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->decimal('amount_paid', 20, 2)->nullable();
            $table->string('amount_for')->nullable();
            $table->date('payment_date')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('created_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panchayat_payments');
    }
};
