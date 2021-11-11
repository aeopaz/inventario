<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entradas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_articulo');
            $table->integer('id_proveedor');
            $table->integer('cantidad');
            $table->double('costo_transporte');
            $table->double('costo_empaque');
            $table->double('costo_envio');
            $table->double('costo_operativo');
            $table->double('valor_compra_articulo');
            $table->integer('id_forma_pago');
            $table->string('notas',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entradas');
    }
}
