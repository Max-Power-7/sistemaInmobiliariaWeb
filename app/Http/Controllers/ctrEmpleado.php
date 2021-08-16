<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;

class ctrEmpleado extends Controller
{
    public function listar(Request $request){
		$empleado=new Empleado();
		$buscar=$request->buscar;
		$criterio=$request->criterio;
		
		if($buscar==''){
            $obj=Empleado::orderBy('empleado.id','desc')
            ->paginate(15);
        }else{
            $obj=Empleado::where($criterio,'like','%'.$buscar.'%')
            ->orderBy('empleado.id','desc')
            ->paginate(5);
        }
    	return $obj;
    }

	public function guardar(Request $request){
		
		$obj=new Empleado();
		$obj->ci=$request->ci;
		$obj->nombre=$request->nombre;
		$obj->apellidos=$request->apellidos;
		$obj->fecha_nacimiento=$request->fecha_nacimiento;
		$obj->telefono=$request->telefono;
		$obj->direccion=$request->direccion;
		$obj->tipo=$request->tipo;	
		$obj->estado='1';
		$obj->save();
	}

	public function modificar(Request $request){

		$obj=Empleado::findOrFail($request->id);
		$obj->ci=$request->ci;
		$obj->nombre=$request->nombre;
		$obj->apellidos=$request->apellidos;
		$obj->fecha_nacimiento=$request->fecha_nacimiento;
		$obj->telefono=$request->telefono;
		$obj->direccion=$request->direccion;
		$obj->tipo=$request->tipo;	
		$obj->estado='1';
		$obj->save();
	}
	
	public function desactivar(Request $request){
		
		$obj=Empleado::findOrFail($request->id);
		$obj->estado='0';
		$obj->save();
	}

	public function activar(Request $request){
		
		$obj=Empleado::findOrFail($request->id);
		$obj->estado='1';
		$obj->save();
	}
}
