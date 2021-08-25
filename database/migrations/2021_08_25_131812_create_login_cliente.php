<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoginCliente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loginCliente', function (Blueprint $table) {
            $table->id();
            $table->string('usuarioCliente',30);
            $table->string('password',30);
            $table->foreignId('idCliente');
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
        Schema::dropIfExists('loginCliente');
    }
}
