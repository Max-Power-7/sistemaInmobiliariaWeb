<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;
    protected $table='cuota';
    protected $fillable=[
        'fecha',
        'monto',
        'estado',
        'idPlanCredito'
    ];
    public $timestamps=false;
}