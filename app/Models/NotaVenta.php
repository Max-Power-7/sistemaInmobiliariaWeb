<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotaVenta extends Model
{
    use HasFactory;
    protected $table='notaventa';
    protected $fillable=[
        'fecha',
        'tipoPago',
        'montoTotal',
        'estado',
        'idPropiedad',
        'idCliente'
    ];

    // public function cliente(){
    //     return $this->hasOne(Cliente::class);
    // }

    public $timestamps=false;
}
