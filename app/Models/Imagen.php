<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imagen extends Model
{
    use HasFactory;
    protected $table='imagen';
    protected $fillable=[
        'foto',
        'descripcionFoto',
        'idPropiedad'
    ];
    public $timestamps=false;
}
