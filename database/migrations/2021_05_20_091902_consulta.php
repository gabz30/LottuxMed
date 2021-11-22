<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Consulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consulta', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_sintomas');
            $table->text('sintomas');
            $table->integer('user_id')->index();
            $table->integer('tipo_consulta_id')->index();
            $table->string('drrefiere')->nullable();
            $table->string('peso')->nullable();
            $table->string('temperatura')->nullable();
            $table->string('exploracion_fisica')->nullable();
            $table->string('estudios_lab')->nullable();
            $table->string('comentario')->nullable();
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
