<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    use HasFactory;
    protected $table='propietario';
    protected $fillable=[
        'ci',
        'nombre',
        'paterno',
        'materno',
        'telefono',
        'direccion',
        'estado'
    ];
    public $timestamps=false;
}
