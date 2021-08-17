<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Propiedad;
use App\Models\Imagen;
use DB;

class ctrPropiedad extends Controller
{
    public function listar(Request $request){
        $criterio=$request->criterio;
        $buscar=$request->buscar;
        
        if($buscar=''){
            $obj=Propiedad::join('localidad','propiedad.idLocalidad','=','localidad.id')
            ->join('propietario','propiedad.idPropietario','=','propietario.id')
            ->select('propiedad.id','propiedad.descripcion','propiedad.metroCuadrado','propiedad.nroPiso',
            'propiedad.inicioConstruccion','propiedad.finConstruccion','propiedad.tipo','propiedad.precio','propiedad.estado','localidad.provincia'
            ,'localidad.municipio','localidad.ciudad')
            ->orderBy('propiedad.id','desc')
            ->get();
        }else{
            $obj=Propiedad::join('localidad','propiedad.idLocalidad','=','localidad.id')
            ->join('propietario','propiedad.idPropietario','=','propietario.id')
            ->select('propiedad.id','propiedad.descripcion','propiedad.metroCuadrado','propiedad.nroPiso',
            'propiedad.inicioConstruccion','propiedad.finConstruccion','propiedad.tipo','propiedad.precio','propiedad.estado','localidad.provincia'
            ,'localidad.municipio','localidad.ciudad')
            //->where($criterio, 'like', '%'.$buscar.'%')
            ->orderBy('propiedad.id','desc')
            ->get();
        }
        return $obj;
    }

    public function guardar(Request $request){      
        if(!$request->ajax()) return redirect('/');
        try{

            DB::beginTransaction();
            $propiedad = new Propiedad();
            $propiedad->codigo=$request->codigo;
            $propiedad->descripcion=$request->descripcion;
            $propiedad->metroCuadrado=$request->metroCuadrado;
            $propiedad->nroPiso=$request->nroPiso;
            $propiedad->precio=$request->precio;
            $propiedad->inicioConstruccion=$request->inicioConstruccion;
            $propiedad->finConstruccion=$request->finConstruccion;
            $propiedad->tipo=$request->tipo;
            $propiedad->precio=$request->precio;
            $propiedad->estado='disponible';
            $propiedad->idPropietario = $request->idPropietario;
            $propiedad->idLocalidad = $request->idLocalidad;
            $propiedad->idAgente = $request->idAgente;
            //$propiedad->idUsuario = \Auth::User()->id; 
            $propiedad->save();

            $detalle = $request->data;
            foreach($detalle as $ep=>$det){
                $obj = new Imagen(); 
                if($det['foto']==null){
                    $obj->foto ='defecto.png';
                }
                else{
                    $explode=explode(',',$det['foto']);
                    $decoded=\base64_decode($explode[1]);
                    if(str_contains($explode[0],'jpeg')){
                        $extension='jpg';
                    }
                    else{
                        $extension='png';
                    }
                    $fileName = \str_random().'.'.$extension;
                    $path= 'img/propiedad'.'/'.$fileName;
                    \file_put_contents($path,$decoded);
                    $obj->foto=$fileName;   
                }

                $obj->descripcionFoto = $det['descripcionFoto'];
                $obj->idPropiedad = $propiedad->id;
                $obj->save();
            }
            DB::commit();
            return[
                'id'=>$propiedad->id
            ];
        } catch (Exception $e){
            DB::rollBack();
        }
    }

    public function desactivar(Request $request){
        $obj= Propiedad::findOrFail($request->id);
        $obj->estado='mantenimiento';
        $obj->save();
    }

    public function activar(Request $request){
        $obj= Propiedad::findOrFail($request->id);
        $obj->estado='disponible';
        $obj->save();
    }
}
