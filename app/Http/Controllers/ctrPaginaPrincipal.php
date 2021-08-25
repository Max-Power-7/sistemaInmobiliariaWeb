<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Models\NotaVenta;
//use App\Models\Cliente;

class ctrPaginaPrincipal extends Controller
{
    public function index(){
        return view('pagina');
    }


}
