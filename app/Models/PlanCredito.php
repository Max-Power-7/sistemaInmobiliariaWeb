<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanCredito extends Model
{
    use HasFactory;
    protected $table='plancredito';
    protected $fillable=[
        'fecha',
        'montoTotal',
        'tipoCredito',
        'plazo',
        'interes',
        'idNotaVenta'
    ];
    public $timestamps=false;
}
