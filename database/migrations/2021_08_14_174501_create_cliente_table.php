<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cliente', function (Blueprint $table) {
            $table->id();
            $table->string('direccion',50);
            $table->string('correo',50)->nullable();
            $table->integer('telefono');
            $table->string('tipo',15);
            $table->integer('ci');
            $table->string('nombre',50)->nullable();
            $table->string('apellidos',50)->nullable();
            $table->string('razonSocial')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cliente');
    }
}
