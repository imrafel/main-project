<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->date('fecha_solicitud');
            $table->date('fecha_practica');
            $table->string('nombreCompleto');
            $table->string('carne')->nullable();
            $table->string('jornada');
            $table->string('carrera');
            $table->string('grado');
            $table->string('programa');
            $table->string('seccion');
            $table->tinyInteger('gerencia')->nullable();
            $table->tinyInteger('bodega')->nullable();
            $table->tinyInteger('compra')->nullable();
            $table->string('finalizado')->default('abierto');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prestamos');
    }
}
