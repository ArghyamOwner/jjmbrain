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
        Schema::table('field_test_kits', function (Blueprint $table) { 
            $table->foreignUlid('bank_id')->nullable()->constrained()->onDelete('set null')->onUpdate('cascade')->after('issue_date');
            $table->string('account_no')->after('bank_id')->nullable();
            $table->string('ifsc_no')->after('account_no')->nullable();
            $table->string('whatsapp_no')->after('ifsc_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
