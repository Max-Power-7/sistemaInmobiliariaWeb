<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localidad extends Model
{
    use HasFactory;
    protected $table='localidad';
    protected $fillable=[
        'provincia',
        'municipio',
        'ciudad',
        'estado'
    ];
    public $timestamps=false;
}
