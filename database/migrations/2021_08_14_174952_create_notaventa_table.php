<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotaventaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notaventa', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->string('tipoPago',15);
            $table->decimal('montoTotal',11,2);
            $table->string('estado',1);
            $table->foreignId('idPropiedad');
            $table->foreignId('idCliente');
            $table->foreign('idPropiedad')->references('id')->on('propiedad');
            $table->foreign('idCliente')->references('id')->on('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notaventa');
    }
}
