<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajaCentimoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caja_centimo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('centimo_id');
            $table->foreign('centimo_id')->references('id')->on('billete')->onDelete('cascade');
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
        Schema::dropIfExists('caja_centimo');
    }
}
