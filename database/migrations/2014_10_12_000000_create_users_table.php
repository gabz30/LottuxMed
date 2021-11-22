<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
          
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('cedula')->nullable();
            $table->string('celular')->nullable();
            $table->string('telefono')->nullable();
            $table->boolean('sexo')->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->text('direccion')->nullable();
            $table->float('salario')->nullable();
            $table->integer('estado_civil_id')->nullable();
            $table->integer('ocupacion_id')->nullable();
            $table->integer('tipo_usuario_id')->nullable();
            $table->integer('grupo_sanguineo_id')->nullable();
            $table->string('estatura')->nullable();
            $table->bigInteger('seguro_afiliado')->nullable();
            $table->string('seguro_plan')->nullable();
            $table->integer('aseguradora_id')->nullable();
            $table->boolean('familiar_doctor')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('authLogin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->boolean('estatus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
