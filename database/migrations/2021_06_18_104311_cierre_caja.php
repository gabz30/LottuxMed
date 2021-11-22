<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CierreCaja extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cierre_caja', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('caja_id')->index();
            $table->float('total_pagos');
            $table->float('efectivo');
            $table->float('tarjeta');
            $table->float('apertura_caja');
            $table->float('cubierto_seguro');
            $table->float('gastos');
            $table->float('total_caja');
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
        //
    }
}
