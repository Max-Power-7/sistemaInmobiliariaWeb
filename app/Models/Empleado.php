<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
	protected $table='empleado'; 
	protected $fillable=['ci','nombre','paterno','materno','fechaNacimiento','sexo','telefono','direccion'];
	public $timestamps=false;
}
