<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaVenta;
use App\Models\PlanCredito;
use App\Models\Cuota;
use App\Models\Propiedad;
use App\Models\Cliente;
use App\Models\LoginCliente;
// use DB;
use Exception;
use Illuminate\Support\Facades\DB;

class ctrNotaVenta extends Controller
{
    public function listar(Request $request)
    {
        $buscar = $request->buscar;
        $criterio = $request->criterio;
        if ($buscar == '') {
            $obj = DB::table('notaventa')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propiedad.id')
                ->select(
                    'notaventa.idCliente',
                    'notaventa.id',
                    'notaventa.fecha',
                    'notaventa.montoTotal',
                    'notaventa.estado',
                    'notaventa.tipoPago',
                    'cliente.nombre as nombreClie',
                    'cliente.apellidos',
                    'cliente.razonSocial',
                    'cliente.tipo as tipoCliente',
                    'propiedad.tipo as tipoPropiedad'
                )
                ->orderBy('notaventa.id', 'desc')
                ->paginate(15);
        } else {
            $obj = DB::table('notaventa')
                ->join('cliente', 'notaventa.idCliente', '=', 'cliente.id')
                ->join('propiedad', 'notaventa.idPropiedad', '=', 'propiedad.id')
                ->select(
                    'notaventa.idCliente',
                    'notaventa.id',
                    'notaventa.fecha',
                    'notaventa.montoTotal',
                    'notaventa.estado',
                    'notaventa.tipoPago',
                    'cliente.nombre as nombreClie',
                    'cliente.apellidos',
                    'cliente.razonSocial',
                    'cliente.tipo as tipoCliente',
                    'propiedad.tipo as tipoPropiedad'
                )
                ->where($criterio, 'like', '%' . $buscar . '%')
                ->orderBy('notaventa.id', 'desc')
                ->paginate(5);
        }
        return $obj;
    }

    public function guardar(Request $request)
    {
        if (!$request->ajax()) return redirect('/');
        try {

            DB::beginTransaction();
            $venta = new NotaVenta();
            $venta->fecha = $request->fecha;
            $venta->tipoPago = $request->tipoPago;
            $venta->montoTotal = $request->montoTotal;
            // $venta->montoTotal=$this->updateCuota($request->montoTotal);
            $venta->estado = '1';
            $venta->idPropiedad = $request->idPropiedad;
            $venta->idCliente = $request->idCliente;
            $venta->save();

            //modificar el estado a vendido a una propiedad
            $prop = Propiedad::findOrFail($request->idPropiedad);
            $prop->estado = 'vendido';
            $prop->save();

            //variable para capturar tipoPago
            $tipoDato = $request->tipoPago;

            if ($tipoDato == 'credito') {
                $planCredito = new PlanCredito();
                $fecha = $request->fecha;
                $montoCredito = $request->montoTotal;

                $planCredito->fecha = $fecha;
                $planCredito->montoTotal = $montoCredito;
                $planCredito->tipoCredito = $request->tipoCredito;
                $planCredito->plazo = $request->plazo;
                $planCredito->interes = $request->interes;
                $planCredito->idNotaVenta = $venta->id;
                $planCredito->save();

                //login cliente
                $loginCliente = new LoginCliente();
                $idCliente = $request->idCliente;
                $datosNombre = $this->mostrarNombre($idCliente);
                $datosCi = $this->mostrarCi($idCliente);
                //datos para crear Login para el cliente
                $loginCliente->usuarioCliente = $datosNombre;
                $loginCliente->password = $datosCi;
                $loginCliente->idCliente = $idCliente;
                $loginCliente->save();

                //cuota
                $detalle = $request->data;
                foreach ($detalle as $ep => $det) {
                    $cuota = new Cuota();
                    $cuota->fecha = $det['fecha'];
                    $cuota->monto = $det['monto'];
                    $cuota->estado = '0';
                    $cuota->idPlanCredito = $planCredito->id;
                    $cuota->save();
                }

                DB::commit();
                return [
                    'id' => $planCredito->id
                ];
            } else {
                DB::commit();
                return [
                    'id' => $venta->id
                ];
            }
        } catch (Exception $e) {
            DB::rollBack();
        }
    }

    //Para calcular IVA
    public function updateMontoTotal($montoTotal)
    {
        $aux = $montoTotal;
        $montoTotal = $montoTotal - ($aux * 0.20);
        return $montoTotal;
    }

    public function montoTotalVenta()
    {
        $venta = NotaVenta::sum('notaventa.montoTotal');
        return $venta;
    }

    public function mostrarNombre($id)
    {
        $obj = Cliente::select('nombre')
            ->where('cliente.id', '=', $id)
            ->first();
        return $obj->nombre;
    }

    public function mostrarCi($id)
    {
        $obj = Cliente::select('ci')
            ->where('cliente.id', '=', $id)
            ->first();
        return $obj->ci;
    }
}
