<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Localidad;

class ctrLocalidad extends Controller
{
    public function listar(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Localidad::orderBy('localidad.id','desc')
            ->paginate(15);
        }else{
            $obj=Localidad::where($criterio,'like','%'.$buscar.'%')
            ->orderBy('localidad.id','desc')
            ->paginate(5);
        }
        return $obj;
    }
    
    public function guardar(Request $request){
        $obj=new Localidad();
        $obj->provincia=$request->provincia;
        $obj->municipio=$request->municipio;
        $obj->ciudad=$request->ciudad;
        $obj->estado='1';
        $obj->save();
    }

    public function modificar(Request $request){
        $obj =Localidad::findOrFail($request->id);
        $obj->provincia=$request->provincia;
        $obj->municipio=$request->municipio;
        $obj->ciudad=$request->ciudad;
        $obj->estado='1';
        $obj->save();
    }
    
    public function desactivar(Request $request){
        $obj= Localidad::findOrFail($request->id);
        $obj->estado='0';
        $obj->save();
    }

    public function activar(Request $request){
        $obj= Localidad::findOrFail($request->id);
        $obj->estado='1';
        $obj->save();
    }
    
    public function listarLocalidad(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Localidad::all();
        }else{
            $obj=Localidad::where('localidad.'.$criterio,'like','%'.$buscar.'%')->get();
        }
        return $obj;
    }
}
