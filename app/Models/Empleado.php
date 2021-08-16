<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;
    protected $table='empleado'; 
	protected $fillable=[	
        'ci',
        'nombre',
        'apellidos',
        'fecha_nacimiento',
        'telefono',
        'direccion',
        'tipo',
        'estado'
    ];
	public $timestamps=false;
}
