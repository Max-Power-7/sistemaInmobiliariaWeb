<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propietario;

class ctrPropietario extends Controller
{
    public function listar(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Propietario::orderBy('propietario.id','desc')
            ->paginate(15);
        }else{
            $obj=Propietario::where($criterio,'like','%'.$buscar.'%')
            ->orderBy('propietario.id','desc')
            ->paginate(5);
        }
        return $obj;
    }
    
    public function guardar(Request $request){
        $obj=new Propietario();
        $obj->ci=$request->ci;
        $obj->nombre=$request->nombre;
        $obj->paterno=$request->paterno;
        $obj->materno=$request->materno;
        $obj->telefono=$request->telefono;
        $obj->direccion=$request->direccion;
        $obj->estado='1';
        $obj->save();
    }

    public function modificar(Request $request){
        $obj =Propietario::findOrFail($request->id);
        $obj->ci=$request->ci;
        $obj->nombre=$request->nombre;
        $obj->paterno=$request->paterno;
        $obj->materno=$request->materno;
        $obj->telefono=$request->telefono;
        $obj->direccion=$request->direccion;
        $obj->estado='1';
        $obj->save();
    }
    
    public function desactivar(Request $request){
        $obj= Propietario::findOrFail($request->id);
        $obj->estado='0';
        $obj->save();
    }

    public function activar(Request $request){
        $obj= Propietario::findOrFail($request->id);
        $obj->estado='1';
        $obj->save();
    }

    public function listarPropietario(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Propietario::all();
        }else{
            $obj=Propietario::where('propietario.'.$criterio,'like','%'.$buscar.'%')->get();
        }
        return $obj;
    }
}
