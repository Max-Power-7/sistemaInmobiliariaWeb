<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agente', function (Blueprint $table) {
            $table->id();
            $table->integer('ci');
            $table->string('nombre',50);
            $table->string('apellidos',50);
            $table->integer('telefono');
            $table->string('direccion',50)->nullable();
            $table->date('fecha_nac');
            $table->string('estado',1);
            $table->foreignId('id_user');
            $table->foreign('id_user')->references('id')->on('usuario');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agente');
    }
}
