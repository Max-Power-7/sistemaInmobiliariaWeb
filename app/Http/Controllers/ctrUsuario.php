<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ctrUsuario extends Controller
{
    public function listar(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $obj = User::/* join('empleado', 'usuario.idEmpleado', '=', 'empleado.id')
                -> */select(
                'usuario.id',
                'usuario.login',
                'usuario.password',
                'usuario.tipo',
                'usuario.estado',
                /* 'empleado.nombre',
                    'empleado.apellidos',
                    'usuario.idEmpleado' */
            )
                ->orderBy('usuario.id', 'desc')->paginate(15);
        } else {
            $obj = User::/* join('empleado', 'usuario.idEmpleado', '=', 'empleado.id')
                -> */select(
                'usuario.id',
                'usuario.login',
                'usuario.password',
                'usuario.tipo',
                'usuario.estado',
                /* 'empleado.nombre',
                    'empleado.apellidos',
                    'usuario.idEmpleado' */
            )
                ->where('usuario.' . $criterio, 'like', '%' . $buscar . '%')
                ->orderBy('usuario.id', 'desc')->paginate(5);
        }
        return $obj;
    }
    public function guardar(Request $request)
    {
        $obj = new User();
        $obj->login = $request->login;
        $obj->password = bcrypt($request->password);
        $obj->tipo = $request->tipo;
        $obj->estado = '1';
        // $obj->idEmpleado = $request->idEmpleado;
        $obj->save();
    }
    public function modificar(Request $request)
    {
        $obj = User::findOrFail($request->id);
        $obj->login = $request->login;
        $obj->password = bcrypt($request->password);
        $obj->tipo = $request->tipo;
        $obj->estado = '1';
        // $obj->idEmpleado = $request->idEmpleado;
        $obj->save();
    }
    public function desactivar(Request $request)
    {
        $obj = User::findOrFail($request->id);
        $obj->estado = '0';
        $obj->save();
    }

    public function activar(Request $request)
    {
        $obj = User::findOrFail($request->id);
        $obj->estado = '1';
        $obj->save();
    }
}
