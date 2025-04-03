<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIndexesToJalshalaSchoolsAndJaldoots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        // create index idx_foreign_key ON jalshala_schools (foreign_key);
        // create index idx_jalshala_school_id ON jaldoots (jalshala_school_id);
        
        // Schema::table('jalshala_schools', function (Blueprint $table) {
        //     $table->index('foreign_key', 'idx_foreign_key');
        // });

        Schema::table('jaldoots', function (Blueprint $table) {
            $table->index('jalshala_school_id', 'idx_jalshala_school_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jalshala_schools', function (Blueprint $table) {
            $table->dropIndex('idx_foreign_key');
        });

        Schema::table('jaldoots', function (Blueprint $table) {
            $table->dropIndex('idx_jalshala_school_id');
        });
    }
}
