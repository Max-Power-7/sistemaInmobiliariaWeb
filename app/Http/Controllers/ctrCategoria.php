<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class ctrCategoria extends Controller
{
    public function listar(Request $request){
        $buscar=$request->buscar;
        if($buscar==''){
            $obj=Categoria::orderBy('categoria.id','desc')
            ->paginate(15);
        }else{
            $obj=Categoria::where('categoria.nombre','like','%'.$buscar.'%')
            ->orderBy('categoria.id','desc')
            ->paginate(5);
        }
        return $obj;
    }
    
    public function guardar(Request $request){
        $obj=new Categoria();
        $obj->nombre=$request->nombre;
        $obj->estado='1';
        $obj->save();
    }
    public function modificar(Request $request){
        $obj=Categoria::findOrFail($request->id);
        $obj->nombre=$request->nombre;   
        $obj->estado='1';
        $obj->save();
    }
    
    public function desactivar(Request $request){
        $obj= Categoria::findOrFail($request->id);
        $obj->estado='0';
        $obj->save();
    }

    public function activar(Request $request){
        $obj= Categoria::findOrFail($request->id);
        $obj->estado='1';
        $obj->save();
    }
}
