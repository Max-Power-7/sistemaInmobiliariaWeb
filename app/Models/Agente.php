<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agente extends Model
{
    use HasFactory;

    protected $table = 'agente';

    protected $fillable = [
        'ci',
        'nombre',
        'apellidos',
        'telefono',
        'direccion',
        'fecha_nac',
        'estado',
        'id_user'
    ];

    public $timestamps = false;
}
