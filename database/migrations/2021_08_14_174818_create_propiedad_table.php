<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropiedadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('propiedad', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion',150);
            $table->string('metroCuadrado',50);
            $table->integer('nroPiso');
            $table->date('inicioConstruccion')->nullable();
            $table->date('finConstruccion')->nullable();
            $table->decimal('precio',11,2);
            $table->string('tipo',50);
            $table->string('estado',1); 
            //$table->foreignId('idCategoria');
            $table->foreignId('idPropietario');
            $table->foreignId('idLocalidad');            
            //$table->foreign('idCategoria')->references('id')->on('categoria');
            $table->foreign('idPropietario')->references('id')->on('propietario');
            $table->foreign('idLocalidad')->references('id')->on('localidad');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('propiedad');
    }
}
