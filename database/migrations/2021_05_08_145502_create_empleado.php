<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpleado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empleado', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('nombre',50);
            $table->string('paterno',50);
            $table->string('materno',50);
            $table->date('fechaNacimiento');
            $table->string('sexo',1);
            $table->integer('telefono')->nullable();
            $table->string('direccion',60)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empleado');
    }
}
