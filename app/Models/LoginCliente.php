<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginCliente extends Model
{
    use HasFactory;
    protected $table='logincliente';
    protected $fillable=[
        'usuarioCliente',
        'password',
        'idCliente'
    ];
    public $timestamps=false;
}
