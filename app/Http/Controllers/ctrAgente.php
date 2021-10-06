<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agente;
use Illuminate\Support\Facades\DB;

class ctrAgente extends Controller
{
    public function listar(Request $request)
    {

        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $obj = Agente::orderBy('agente.id', 'desc')
                ->paginate(15);

            /* Consulta con ORM Eloquent para mostrar la cantidad de ventas realizadas por cada agente */
            // $aux = DB::table('agente')
            //     ->join('propiedad', 'propiedad.idAgente', '=', 'agente.id')
            //     ->join('notaventa', 'propiedad.id_nota', '=', 'notaventa.id')
            //     ->count('agente.id');
            // ->select('count(agente.id)')
            // ->where()
            // ->get();

            /* Consulta SQL que se desea realizar una vez se tengan más registros en las tablas*/
            /* SELECT count(agente.id)
                from agente
                Inner join propiedad on propiedad.idAgente = agente.id
                inner join notaventa on notaventa.idPropiedad = propiedad.id
            */
        } else {
            $obj = Agente::where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('agente.id', 'desc')
                ->paginate(5);
        }
        return $obj;
    }

    public function guardar(Request $request)
    {
        $obj = new Agente();
        $obj->ci = $request->ci;
        $obj->nombre = $request->nombre;
        $obj->apellidos = $request->apellidos;
        $obj->telefono = $request->telefono;
        $obj->direccion = $request->direccion;
        $obj->fecha_nac = $request->fecha_nac;
        $obj->id_user = $request->id_user;
        $obj->estado = '1';
        $obj->save();
    }

    public function modificar(Request $request)
    {
        $obj = Agente::findOrFail($request->id);
        $obj->ci = $request->ci;
        $obj->nombre = $request->nombre;
        $obj->apellidos = $request->apellidos;
        $obj->telefono = $request->telefono;
        $obj->direccion = $request->direccion;
        $obj->fecha_nac = $request->fecha_nac;
        $obj->id_user = $request->id_user;
        $obj->estado = '1';
        $obj->save();
    }

    public function desactivar(Request $request)
    {
        $obj = Agente::findOrFail($request->id);
        $obj->estado = '0';
        $obj->save();
    }

    public function activar(Request $request)
    {
        $obj = Agente::findOrFail($request->id);
        $obj->estado = '1';
        $obj->save();
    }
    public function listarAgente(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;

        if ($buscar == '') {
            $obj = Agente::all();
        } else {
            $obj = Agente::where('agente.' . $criterio, 'like', '%' . $buscar . '%')->get();
        }
        return $obj;
    }

    public function cantidadAgente()
    {
        $prop = Agente::count('agente.id');
        return $prop;
    }
}
