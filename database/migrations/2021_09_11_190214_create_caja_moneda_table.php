<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaMonedaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_moneda', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('moneda_id');
            $table->foreign('moneda_id')->references('id')->on('moneda')->onDelete('cascade');
            $table->unsignedBigInteger('mcaja_id');
            $table->foreign('mcaja_id')->references('id')->on('movimiento_caja')->onDelete('cascade');
            $table->decimal("cantidad");
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
        Schema::dropIfExists('caja_moneda');
    }
}
