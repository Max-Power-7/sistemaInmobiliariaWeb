<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ctrCliente;
use App\Http\Controllers\ctrPropietario;
use App\Http\Controllers\ctrCategoria;
use App\Http\Controllers\ctrLocalidad;
use App\Http\Controllers\ctrEmpleado;
use App\Http\Controllers\ctrUsuario;
use App\Http\Controllers\ctrPropiedad;
use App\Http\Controllers\ctrImagen;
use App\Http\Controllers\ctrNotaVenta;
use App\Http\Controllers\ctrAgente;
use App\Http\Controllers\ctrPago;
use App\Http\Controllers\ctrCuota;
use App\Http\Controllers\ctrLoginCliente;
use App\Http\Controllers\ctrPaginaPrincipal;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('contenido/contenido');
// });
// Auth::routes();
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/',[ctrPaginaPrincipal::class,'index']);

Route::group(['middleware'=>['guest']],function(){
    Route::get('/sistema',[LoginController::class, 'showLoginForm']);
    Route::post('/usuario',[LoginController::class, 'usuario'])->name('usuario');
});
Auth::routes();
Route::group(['middleware'=>['auth']],function(){    
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('/main', function () {
        return view('contenido/contenido');
    })->name('main');

    //CLIENTE
    Route::get('/cliente',[ctrCliente::class,'listar']);
    Route::post('/cliente/guardar',[ctrCliente::class,'guardar']);
    Route::put('/cliente/modificar',[ctrCliente::class,'modificar']);
    Route::delete('/cliente/eliminar/{id}',[ctrCliente::class,'eliminar']);
    Route::get('/cliente/listado',[ctrCliente::class,'listarCliente']);

    //PROPIETARIO
    Route::get('/propietario',[ctrPropietario::class,'listar']);
    Route::post('/propietario/guardar',[ctrPropietario::class,'guardar']);
    Route::put('/propietario/modificar',[ctrPropietario::class,'modificar']);
    Route::put('/propietario/desactivar',[ctrPropietario::class,'desactivar']);
    Route::put('/propietario/activar',[ctrPropietario::class,'activar']);
    Route::get('/propietario/listado',[ctrPropietario::class,'listarPropietario']);

    //CATEGORIA
    Route::get('/categoria',[ctrCategoria::class,'listar']);
    Route::post('/categoria/guardar',[ctrCategoria::class,'guardar']);
    Route::put('/categoria/modificar',[ctrCategoria::class,'modificar']);
    Route::put('/categoria/desactivar',[ctrCategoria::class,'desactivar']);
    Route::put('/categoria/activar',[ctrCategoria::class,'activar']);

    //LOCALIDAD
    Route::get('/localidad',[ctrLocalidad::class,'listar']);
    Route::post('/localidad/guardar',[ctrLocalidad::class,'guardar']);
    Route::put('/localidad/modificar',[ctrLocalidad::class,'modificar']);
    Route::put('/localidad/desactivar',[ctrLocalidad::class,'desactivar']);
    Route::put('/localidad/activar',[ctrLocalidad::class,'activar']);
    Route::get('/localidad/listado',[ctrLocalidad::class,'listarLocalidad']);

    //EMPLEADO
    Route::get('/empleado',[ctrEmpleado::class,'listar']);
    Route::post('/empleado/guardar',[ctrEmpleado::class,'guardar']);
    Route::put('/empleado/modificar',[ctrEmpleado::class,'modificar']);
    Route::put('/empleado/desactivar',[ctrEmpleado::class,'desactivar']);
    Route::put('/empleado/activar',[ctrEmpleado::class,'activar']);
    Route::get('/empleado/select',[ctrEmpleado::class,'selectEmpleado']);

    //USUARIO
    Route::get('/usuario',[ctrUsuario::class,'listar']);
    Route::post('/usuario/guardar',[ctrUsuario::class,'guardar']);
    Route::put('/usuario/modificar',[ctrUsuario::class,'modificar']);
    Route::put('/usuario/desactivar',[ctrUsuario::class,'desactivar']);
    Route::put('/usuario/activar',[ctrUsuario::class,'activar']);

    //IMAGEN
    Route::get('/imagen/slider',[ctrImagen::class,'sliderImagen']);

    //PROPIEDAD
    Route::get('/propiedad',[ctrPropiedad::class,'listar']);
    Route::post('/propiedad/guardar',[ctrPropiedad::class,'guardar']);
    Route::put('/propiedad/modificar',[ctrPropiedad::class,'modificar']);
    Route::put('/propiedad/desactivar',[ctrPropiedad::class,'desactivar']);
    Route::put('/propiedad/activar',[ctrPropiedad::class,'activar']);
    //Route::delete('/empleado/eliminar/{id}', 'ctrlEmpleado@eliminar');
    Route::get('/propiedad/cantidad',[ctrPropiedad::class,'cantidadPropiedad']);
    
    //NOTA VENTA
    Route::get('/notaventa',[ctrNotaVenta::class,'listar']);
    Route::post('/notaventa/guardar',[ctrNotaVenta::class,'guardar']); 
    Route::get('/notaventa/montoT',[ctrNotaVenta::class,'montoTotalVenta']);

    //Route::get('/notaventa/mostrarNombre',[ctrNotaVenta::class,'mostrarNombre']);
  
    //AGENTE
    Route::get('/agente',[ctrAgente::class,'listar']);
    Route::post('/agente/guardar',[ctrAgente::class,'guardar']);
    Route::put('/agente/modificar',[ctrAgente::class,'modificar']);
    Route::put('/agente/desactivar',[ctrAgente::class,'desactivar']);
    Route::put('/agente/activar',[ctrAgente::class,'activar']);
    Route::get('/agente/listado',[ctrAgente::class,'listarAgente']);
    Route::get('/agente/cantidad',[ctrAgente::class,'cantidadAgente']);
   
    //PAGO
    //Route::get('/pago',[ctrPago::class,'listar']);
    Route::post('/pago/guardar',[ctrPago::class,'guardar']);
    
    //CUOTA
    Route::get('/cuota',[ctrCuota::class,'listar']);
});
    //LOGIN CLIENTE
    Route::get('/logincliente',[ctrLoginCliente::class,'iniciar']);  
    Route::get('/cuota/listar',[ctrCuota::class,'listarCuota']);