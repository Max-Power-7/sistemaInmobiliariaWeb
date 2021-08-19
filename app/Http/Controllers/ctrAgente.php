<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;
class ctrAgente extends Controller
{
    public function listar(Request $request){
	
		$buscar=$request->buscar;
		$criterio=$request->criterio;
		
		if($buscar==''){
            $obj=Agente::orderBy('agente.id','desc')
            ->paginate(15);
        }else{
            $obj=Agente::where($criterio,'like','%'.$buscar.'%')
            ->orderBy('agente.id','desc')
            ->paginate(5);
        }
    	return $obj;
    }

	public function guardar(Request $request){
		
		$obj=new Agente();
		$obj->ci=$request->ci;
		$obj->nombre=$request->nombre;
		$obj->apellidos=$request->apellidos;
		$obj->telefono=$request->telefono;
		$obj->direccion=$request->direccion;	
		$obj->estado='1';
		$obj->save();
	}

	public function modificar(Request $request){

		$obj=Agente::findOrFail($request->id);
		$obj->ci=$request->ci;
		$obj->nombre=$request->nombre;
		$obj->apellidos=$request->apellidos;
		$obj->telefono=$request->telefono;
		$obj->direccion=$request->direccion;	
		$obj->estado='1';
		$obj->save();
	}
	
	public function desactivar(Request $request){
		
		$obj=Agente::findOrFail($request->id);
		$obj->estado='0';
		$obj->save();
	}

	public function activar(Request $request){
		
		$obj=Agente::findOrFail($request->id);
		$obj->estado='1';
		$obj->save();
	}
    public function listarAgente(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Agente::all();
        }else{
            $obj=Agente::where('agente.'.$criterio,'like','%'.$buscar.'%')->get();
        }
        return $obj;
    }

	public function cantidadAgente(){
        $prop=Agente::count('agente.id');
        return $prop;
    }
}
