<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
class ctrEmpleado extends Controller
{
    public function listarEmpleado(Request $request){
		$empleado=new Empleado();
		$buscar=$request->buscar;
		$tipoBusqueda=$request->tipoBusqueda;
		if ($buscar=='') {
			$obj=$empleado::all();	
		}else{
			$obj=$empleado::where($tipoBusqueda,'like','%'.$buscar.'%')
			->orderBy('empleado.id','desc')
			->get();
		}
    	return $obj;
    }

	public function listar(Request $request){
		$empleado=new Empleado();
		$buscar=$request->buscar;
		$tipoBusqueda=$request->tipoBusqueda;
		if ($buscar=='') {
			$obj=$empleado::all();	
		}else{
			$obj=$empleado::where($tipoBusqueda,'like','%'.$buscar.'%')
			->orderBy('empleado.id','desc')
			->get();
		}
    	return response(json_encode($obj));
    }

	public function guardarEmpleado(Request $request){
		
		$empleado=new Empleado();
		$empleado->ci=$request->ci;
		$empleado->nombre=$request->nombre;
		$empleado->paterno=$request->paterno;
		$empleado->materno=$request->materno;
		$empleado->fechaNacimiento=$request->fechaNacimiento;
		$empleado->sexo=$request->sexo;
		$empleado->telefono=$request->telefono;
		$empleado->direccion=$request->direccion;
		$empleado->save();
	}

	public function modificarEmpleado(Request $request){

		$empleado=Empleado::findOrFail($request->id);
		$empleado->ci=$request->ci;
		$empleado->nombre=$request->nombre;
		$empleado->paterno=$request->paterno;
		$empleado->materno=$request->materno;
		$empleado->fechaNacimiento=$request->fechaNacimiento;
		$empleado->sexo=$request->sexo;
		$empleado->telefono=$request->telefono;
		$empleado->direccion=$request->direccion;
		$empleado->save();
	}
	
	public function eliminarEmpleado(Request $request){
		
		$empleado=Empleado::findOrFail($request->id);
		$empleado->delete();
	}
}

