<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleMaterialYEquiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_material_y_equipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('material_id')->unsigned();
            $table->integer('cantidad');
            $table->string('descripcion');
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('material_y_equipos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detalle_material_y_equipos');
    }
}
