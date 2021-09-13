<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $table = 'cliente';
    protected $fillable = [
        'direccion',
        'correo',
        'telefono',
        'tipo',
        'ci',
        'nombre',
        'apellidos',
        'razonSocial'
    ];
    public $timestamps = false;
}
