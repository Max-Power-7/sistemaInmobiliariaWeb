<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ctrCliente extends Controller
{
    public function listar(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Cliente::orderBy('cliente.id','desc')
            ->paginate(15);
        }else{
            $obj=Cliente::where($criterio,'like','%'.$buscar.'%')
            ->orderBy('cliente.id','desc')
            ->paginate(5);
        }
        return $obj;
    }
    
    public function guardar(Request $request){
        $cliente=new Cliente();
        $cliente->direccion=$request->direccion;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->tipo=$request->tipo;
        $cliente->nombre=$request->nombre;
        $cliente->apellidos=$request->apellidos;
        $cliente->razonSocial=$request->razonSocial;
        $cliente->save();
    }
    public function modificar(Request $request){
        $cliente= Cliente::findOrFail($request->id);
        $cliente->direccion=$request->direccion;
        $cliente->correo=$request->correo;
        $cliente->telefono=$request->telefono;
        $cliente->tipo=$request->tipo;
        $cliente->nombre=$request->nombre;
        $cliente->apellidos=$request->apellidos;
        $cliente->razonSocial=$request->razonSocial;
        $cliente->save();
    }
    
    public function eliminar(Request $request){
        $cliente= Cliente::findOrFail($request->id);
        $cliente->delete();
    }

    public function listarCliente(Request $request){
        $buscar=$request->buscar;
        $criterio=$request->criterio;
        
        if($buscar==''){
            $obj=Cliente::all();
        }else{
            $obj=Cliente::where('cliente.'.$criterio,'like','%'.$buscar.'%')->get();
        }
        return $obj;
    }
}
