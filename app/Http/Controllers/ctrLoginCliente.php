<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginCliente;

class ctrLoginCliente extends Controller
{
    public function iniciar(Request $request){
        $usuarioCliente=$request->usuarioCliente;
        $contraseña=$request->contraseña;

        $obj=LoginCliente::join('cliente','logincliente.idCliente','=','cliente.id')
        ->select('cliente.ci','cliente.nombre','cliente.apellidos','cliente.id as clienteId')
        ->where('loginCliente.usuarioCliente','=',$usuarioCliente)
        ->where('loginCliente.password','=',$contraseña)
        ->first();

        if($obj){
            return $obj;
        }else{
            return 0;
        }
    }        
}
