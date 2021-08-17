<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    use HasFactory;
    protected $table='pago';
    protected $fillable=[
        'fecha',
        'monto',
        'estado',
        'idCuota'
    ];
    public $timestamps=false;
}
