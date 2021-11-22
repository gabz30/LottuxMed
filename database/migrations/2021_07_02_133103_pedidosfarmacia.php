<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pedidosfarmacia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidosfarmacia', function (Blueprint $table) {
            $table->id();
            $table->integer('farmacia_id')->index();
            $table->integer('paciente_id')->index();
            $table->integer('drID')->index();
            $table->integer('consulta_id')->index();
            $table->boolean('estatus');
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
