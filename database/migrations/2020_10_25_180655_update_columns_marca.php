<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnsMarca extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('marca', function (Blueprint $table) {
            $table->integer('created_by')->nullable()->index('created_by_idx');
            $table->integer('updated_by')->nullable()->index('updated_by_idx');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('marca', 'created_by')) {
            Schema::table('marca', function (Blueprint $table) {
                $table->dropColumn('created_by');
            });
        }
        if (Schema::hasColumn('marca', 'updated_by')) {
            Schema::table('marca', function (Blueprint $table) {
                $table->dropColumn('updated_by');
            });
        }
        
    }
}
