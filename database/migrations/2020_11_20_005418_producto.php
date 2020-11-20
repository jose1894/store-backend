<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Producto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('producto', function (Blueprint $table) {
            $table->increments('id');
            $table->string('codigo',25)->unique();
            $table->string('nombre');
            $table->string('imagen')->nullable();
            $table->text('descripcion')->nullable();
            $table->decimal('precio_compra',12,2)->default(0);
            $table->decimal('precio_venta',12,2)->default(0);
            $table->unsignedInteger('modelo_id')->nullable(); 
            $table->foreign('modelo_id')->references('id')->on('modelos')
                  ->onUpdate('CASCADE')
                  ->onDelete('RESTRICT');
            $table->unsignedInteger('undmed_id')->nullable(); 
            $table->foreign('undmed_id')->references('id')->on('unidad_medida')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
            $table->unsignedInteger('categoria_id')->nullable(); 
            $table->foreign('categoria_id')->references('id')->on('categorias')
                    ->onUpdate('CASCADE')
                    ->onDelete('RESTRICT');
            $table->unsignedInteger('tipoprod_id')->nullable(); 
            $table->foreign('tipoprod_id')->references('id')->on('tipo_productos')
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
        //
        Schema::dropIfExists('producto');
    }
}
