<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Cuota;

class ctrPago extends Controller
{
    public function listar(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $obj = Pago::join('cuota', 'pago.idCuota', '=', 'cuota.id')
                ->join('plancredito', 'cuota.idPlanCredito', '=', 'plancredito.id')
                ->join('notaventa', 'plancredito.idNotaVenta', '=', 'notaventa.id')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propieadad.id')
                ->select(
                    'pago.id',
                    'pago.fecha as fechaPago',
                    'pago.monto as montoPago',
                    'cliente.nombre',
                    'cliente.apellidos',
                    'cliente.razonSocial',
                    'propiedad.codigo',
                    'propiedad.tipo as tipoPropieadad',
                    'planCredito.montoTotal as totalPagar'
                )
                ->orderBy('pago.id', 'desc')->paginate(15);
        } else {
            $obj = Pago::join('cuota', 'pago.idCuota', '=', 'cuota.id')
                ->join('plancredito', 'cuota.idPlanCredito', '=', 'plancredito.id')
                ->join('notaventa', 'plancredito.idNotaVenta', '=', 'notaventa.id')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propieadad.id')
                ->select(
                    'pago.id',
                    'pago.fecha as fechaPago',
                    'pago.monto as montoPago',
                    'cliente.nombre',
                    'cliente.apellidos',
                    'cliente.razonSocial',
                    'propiedad.codigo',
                    'propiedad.tipo as tipoPropieadad',
                    'planCredito.montoTotal as totalPagar'
                )
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('pago.id', 'desc')->paginate(5);
        }
        return $obj;
    }
    public function guardar(Request $request)
    {
        $obj = new Pago();
        $obj->fecha = $request->fecha;
        $obj->monto = $request->monto;
        $obj->estado = '1';
        $obj->idCuota = $request->idCuota;
        $obj->save();

        //modifica el estado de la cuota a 1
        $cuota = Cuota::findOrFail($request->idCuota);
        $cuota->estado = '1';
        $cuota->save();
    }
}
