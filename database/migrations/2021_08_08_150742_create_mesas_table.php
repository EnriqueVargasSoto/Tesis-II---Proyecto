<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mesas', function (Blueprint $table) {
            $table->id();
            $table->string('numero');
            $table->string('url_imagen');
            $table->string('nombre_imagen');
            $table->text('descripcion');
            $table->unsignedBigInteger('tipomesa_id');
            $table->foreign('tipomesa_id')->references('id')->on('tipo_mesa')->onDelete('cascade');
            $table->unsignedBigInteger('ambiente_id');
            $table->foreign('ambiente_id')->references('id')->on('ambiente')->onDelete('cascade');
            $table->enum('disponibilidad',['OCUPADO','DISPONIBLE'])->default('DISPONIBLE');
            $table->enum('estado',['ACTIVO','ANULADO'])->default('ACTIVO');
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
        Schema::dropIfExists('mesas');
    }
}
