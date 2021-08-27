<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuota;

class ctrCuota extends Controller
{
    public function listar(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $obj = Cuota::join('plancredito', 'cuota.idPlanCredito', '=', 'plancredito.id')
                ->join('notaventa', 'plancredito.idNotaVenta', '=', 'notaventa.id')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propiedad.id')
                ->select(
                    'propiedad.codigo as codigoPropiedad',
                    'cliente.nombre as nombre',
                    'cliente.apellidos as apellidos',
                    // 'cliente.razonSocial',
                    'propiedad.descripcion as descripcion',
                    'cuota.fecha as fechaCuota',
                    'propiedad.tipo as tipoPropiedad',
                    'cuota.monto as montoCuota',
                    'planCredito.montoTotal as totalPagar',
                    'cuota.id as idCuota',
                    'cuota.estado'
                )
                ->orderBy('cuota.id', 'desc')->paginate(15);
        } else {
            $obj = Cuota::join('plancredito', 'cuota.idPlanCredito', '=', 'plancredito.id')
                ->join('notaventa', 'plancredito.idNotaVenta', '=', 'notaventa.id')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propiedad.id')
                ->select(
                    'propiedad.codigo as codigoPropiedad',
                    'cliente.nombre as nombre',
                    'cliente.apellidos as apellidos',
                    // 'cliente.razonSocial',
                    'propiedad.descripcion as descripcion',
                    'cuota.fecha as fechaCuota',
                    'propiedad.tipo as tipoPropiedad',
                    'cuota.monto as montoCuota',
                    'planCredito.montoTotal as totalPagar',
                    'cuota.id as idCuota',
                    'cuota.estado'
                )
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('cuota.id', 'desc')->paginate(5);
        }
        return $obj;
        // return ["hola" => $obj];
    }

    public function listarCuota(Request $request)
    {

        $buscar = $request->buscar;
        $ci = $request->ci;
        $obj = Cuota::join('plancredito', 'cuota.idPlanCredito', '=', 'plancredito.id')
            ->join('notaventa', 'plancredito.idNotaVenta', '=', 'notaventa.id')
            ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
            ->join('propiedad', 'notaventa.idPropiedad', '=', 'propiedad.id')
            ->select(
                'propiedad.codigo as codigoPropiedad',
                'cuota.fecha as fechaCuota',
                'propiedad.tipo as tipoPropiedad',
                'cuota.monto as montoCuota',
                'planCredito.montoTotal as totalPagar',
                'cuota.id as idCuota',
                'cuota.estado'
            )
            ->orderBy('cuota.id', 'asc')
            ->where('propiedad.codigo', '=', $buscar)
            ->where('cliente.ci', '=', $ci)
            ->get();

        return $obj;
    }
}
