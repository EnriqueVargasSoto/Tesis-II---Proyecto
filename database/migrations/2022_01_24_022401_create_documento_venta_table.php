<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentoVentaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documento_venta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes')->onDelete('cascade');
            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')->references('id')->on('pedido')->onDelete('cascade');

            $table->unsignedBigInteger('correlativo_id')->nullable();
            $table->foreign('correlativo_id')->references('id')->on('numeracion_conteo')->onDelete('cascade');
            $table->unsignedBigInteger('tipo_documento_id')->nullable();
            $table->foreign('tipo_documento_id')->references('id')->on('tipo_documento')->onDelete('cascade');
            $table->decimal('total');
            $table->string('url_qr')->nullable();
            $table->string('nombre_comprobante_archivo')->nullable();
            $table->string('url_comprobante_archivo')->nullable();
            $table->longText('hash')->nullable();
            $table->json('cdr_response')->nullable();
            $table->json('regularize_response')->nullable();
            $table->enum('regularize', ['0', '1'])->default('0');
            $table->enum('estado_documento', ['PENDIENTE', 'ERROR', 'REGISTRADO', 'ACEPTADO'])->default('PENDIENTE');
            $table->enum('estado', ['ACTIVO', 'ANULADO'])->default('ACTIVO');
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
        Schema::dropIfExists('documento_venta');
    }
}
