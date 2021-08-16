<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Imagen;

class ctrImagen extends Controller
{
    public function sliderImagen(Request $request){
        $imagen=Imagen::where('imagen.idPropiedad','=',$request->id)->pluck('imagen.foto');
        return $imagen;
    }
}
