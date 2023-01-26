<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_prestamos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('prestamo_id')->unsigned();
            $table->bigInteger('articulo_id')->unsigned();
            $table->integer('cantidad');
            $table->string('herramienta');
            $table->string('descripcion');
            $table->string('entregado')->nullable();
            $table->string('observacion')->nullable();
            $table->timestamps();

            $table->foreign('prestamo_id')->references('id')->on('prestamos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_prestamos');
    }
}
