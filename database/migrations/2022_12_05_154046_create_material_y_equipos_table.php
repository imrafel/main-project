<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialYEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('material_y_equipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('nombreCompleto');
            $table->date('fecha_solicitud');
            $table->date('fecha_practica');
            $table->string('carrera');
            $table->string('programa');
            $table->string('grado');
            $table->string('jornada');
            $table->string('practica');
            $table->string('tipo'); // planificaion anual o modular
            $table->tinyInteger('gerencia')->nullable();
            $table->tinyInteger('bodega')->nullable();
            $table->tinyInteger('compra')->nullable();
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
        Schema::dropIfExists('material_y_equipos');
    }
}
