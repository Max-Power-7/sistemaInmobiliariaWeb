<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propiedad extends Model
{
    use HasFactory;
    protected $table='propiedad';
    protected $fillable=[
        'codigo',
        'descripcion',
        'metroCuadrado',
        'nroPiso',
        'inicioConstruccion',
        'finConstruccion',
        'precio',
        'tipo',
        'estado',
        'idPropietario',
        'idLocalidad',
        'idAgente'
    ];
    public $timestamps=false;
}
