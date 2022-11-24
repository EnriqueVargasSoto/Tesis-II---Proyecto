<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_compra', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('proveedor_id');
            $table->foreign('proveedor_id')->references('id')->on('proveedor')->onDelete('cascade');
            $table->unsignedBigInteger('deposito_id');
            $table->foreign('deposito_id')->references('id')->on('deposito')->onDelete('cascade');
            $table->string('ruta_imagen')->nullable();
            $table->string('nombre_imagen')->nullable();
            $table->dateTime('fecha_emision');
            $table->dateTime('fecha_entrega');
            $table->enum('modo_compra',['CONTADO','CREDITO']);
            $table->enum('tipo_moneda',['SOLES','DOLARES']);
            $table->enum('igv',['Si','No']);
            $table->decimal('cantidad_igv');
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
        Schema::dropIfExists('doc_compra');
    }
}
