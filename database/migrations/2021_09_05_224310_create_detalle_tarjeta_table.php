<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalleTarjetaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalle_tarjeta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tarjeta_id');
            $table->foreign('tarjeta_id')->references('id')->on('tarjeta')->onDelete('cascade');
            $table->unsignedBigInteger('pago_id');
            $table->foreign('pago_id')->references('id')->on('pago')->onDelete('cascade');
            $table->string('cuenta')->nullable();
            $table->string('cci')->nullable();
            $table->string('cantidad')->nullable();
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
        Schema::dropIfExists('detalle_tarjeta');
    }
}
