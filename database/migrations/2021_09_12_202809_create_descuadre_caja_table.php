<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDescuadreCajaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('descuadre_caja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mcaja_id');
            $table->foreign('mcaja_id')->references('id')->on('movimiento_caja')->onDelete('cascade');
            $table->decimal('descuadre');
            $table->text('descripcion')->nullable();
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
        Schema::dropIfExists('descuadre_caja');
    }
}
