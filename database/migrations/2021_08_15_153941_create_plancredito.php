<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlancredito extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plancredito', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('montoTotal',11,2);
            $table->string('tipoCredito',30);
            $table->string('plazo',30);
            $table->decimal('interes',11,2);
            $table->foreignId('idNotaVenta');
            $table->foreign('idNotaVenta')->references('id')->on('notaventa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plancredito');
    }
}
