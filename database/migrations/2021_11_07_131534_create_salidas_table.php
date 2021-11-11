<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salidas', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->integer('id_vendedor');
            $table->integer('id_articulo');
            $table->integer('cantidad');
            $table->double('precio_unitario');
            $table->double('precio_total');
            $table->double('descuento');
            $table->double('precio_venta');
            $table->integer('id_forma_pago');
            $table->string('tipo_salida');
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
        Schema::dropIfExists('salidas');
    }
}
