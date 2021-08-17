<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuota', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->decimal('monto',11,2);
            $table->string('estado',1);
            $table->foreignId('idPlanCredito');
            $table->foreign('idPlanCredito')->references('id')->on('plancredito');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuota');
    }
}
