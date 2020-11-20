<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    
        Schema::create('modelos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descripcion')->unique();
            $table->unsignedInteger('marca_id'); 
            $table->foreign('marca_id')->references('id')->on('marcas')
                  ->onUpdate('CASCADE')
                  ->onDelete('RESTRICT');
            $table->integer('created_by')->nullable()->index('created_by_idx');
            $table->integer('updated_by')->nullable()->index('updated_by_idx');
            $table->timestamps();
            $table->engine = 'InnoDB';	
            $table->charset = 'utf8';	
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modelos');
    }
}
