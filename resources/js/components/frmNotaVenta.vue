<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    Nota de Venta
                    <button type="button" @click="abrirNotaVenta()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado y busqueda de Nota Venta -->
                <template v-if="listado==0">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="notaventa.id">Codigo</option>
                                        <option value="notaventa.fecha">Fecha</option>
                                        <option value="cliente.nombre">Cliente</option>
                                        <option value="cliente.razonSocial">Empresa</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listar(1,buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listar(1,buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Codigo</th>
                                    <th>Fecha</th>
                                    <th>Tipo de Pago</th>
                                    <th>Monto Total</th>
                                    <th>Propiedad</th>
                                    <th>Cliente</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="notaventa in arrayNotaVenta" :key="notaventa.id">

                                    <td v-text="notaventa.id"></td>
                                    <td v-text="notaventa.fecha"></td>
                                    <td v-text="notaventa.tipoPago"></td>
                                    <td v-text="notaventa.montoTotal"></td>
                                    <td v-text="notaventa.tipoPropiedad"></td>

                                    <template v-if="notaventa.tipoCliente=='persona'">
                                        <td v-text="notaventa.nombreClie"></td>
                                    </template>

                                    <template v-if="notaventa.tipoCliente=='empresa'">
                                        <td v-text="notaventa.razonSocial"></td>
                                    </template>

                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Accion
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item bg-light" href="#"><i class="icon-pencil text-warning"></i>Contrato</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <nav>
                            <ul class="pagination">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar,criterio)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar,criterio)" v-text="page">1</a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar,criterio)">Sig</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </template>

                <template v-if="listado==1">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                    <div class="form-group row border">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Cliente">Cliente</label>
                                                <div class="form-inline">
                                                    <input type="hidden" v-model="idCliente">
                                                    <input type="text" class="form-control" v-model="nombreCliente" disabled>
                                                    <button type="button" class="btn btn-success" @click="abrirModalNuevoCliente()">
                                                    <i class="fa fa-user-plus"></i></button>
                                                    <button type="button" @click="abrirModalCliente()" class="btn btn-info"><i class="fa fa-window-maximize"> Cliente</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="form-group row">
                                    <div class="table-responsive col-md-12">
                                        <div class="card mb-4" style="max-width: 800px;" v-for="imagen in arrayImagen" :key="imagen.id">
                                            <div class="row no-gutters">
                                                <div class="col-md-4">
                                                    <img :src="imagen.foto" height="220" width="250">
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Descripcion</h5>
                                                        <p class="card-text">{{imagen.descripcionFoto}}</p>
                                                        <p class="card-text"><small class="text-muted">Hace un momento</small></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                 </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="form-group row border">
                                    <table class="table table-bordered table-sm">
                                        <thead class="table-info">
                                            <th>Opciones</th>
                                            <th>Codigo</th>
                                            <th>Propiedad</th>
                                            <th>Monto Total</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td v-if="idPropiedad>0"><button type="button" @click="eliminarPropiedad()" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-window-close"></i>
                                                    </button>
                                                </td>
                                                <td v-text="idPropiedad"></td>
                                                <td v-text="nombreP"></td>
                                                <td v-text="preciov">Bs</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group row border">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Propiedad</label>
                                            <p>
                                                <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                                    Propiedad
                                                </button>
                                            </p>
                                            <div class="collapse" id="collapseExample">
                                                <div class="card card-body">
                                                    <div class="form-group row">
                                                        <div class="col-md-6">
                                                            <div class="input-group">
                                                                <select class="form-control col-md-3" v-model="criterioPropiedad">
                                                                    <option value="propiedad.codigo">Codigo</option>
                                                                </select>
                                                                <input type="text" v-model="buscarPropiedad" @keyup.enter="listarPropiedad(buscarPropiedad, criterioPropiedad)" class="form-control" placeholder="Texto a buscar">
                                                                <button type="submit" @click="listarPropiedad(buscarPropiedad, criterioPropiedad)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-deck" style="overflow-y: auto; height: 320px;">
                                                        <div class="col-md-2.5" v-for="propiedad in arrayPropiedad" :key="propiedad.id">
                                                            <div class="card" v-if="propiedad.estado=='disponible'">
                                                                <img :src="'img/photo2.png'" @click="sliderImagen(propiedad.id)" data-toggle="modal" data-target="#modalSlider" class="card-img-top" width="100" height="100" align="left" alt="">

                                                                <div class="card-body">
                                                                    <center>

                                                                            <font size="5" face="Times New Roman"><span class="badge badge-warning">Disponible</span></font>
                                                                        <center>
                                                                            <button type="button" class="btn btn-success" @click="verPropiedad(propiedad)"><i size="5" class="fa fa-eye"></i>Ver</button>
                                                                        </center>
                                                                        <font size="3" face="Times New Roman"><b>Tipo: </b>{{propiedad.tipo}}</font><br>
                                                                        <font size="3" face="Times New Roman"><b>Precio: </b>{{propiedad.precio}} Bs</font><br>
                                                                    </center>
                                                                </div>
                                                                <div class="card-footer">
                                                                    <button type="button" @click="agregarPropiedad(propiedad)" class="btn btn-primary btn-sm">
                                                                        Agregar <i class="fa fa-check"></i>
                                                                    </button>
                                                                    <template v-if="propiedad.estado=='Mantenimiento'">
                                                                        <button type="button" @click="habilitarPropiedad(propiedad.id)" class="btn btn-primary btn-sm"><i class="fa fa-lock"></i> Habilitar</button>
                                                                    </template>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Tipo de Pago</label>
                                <select class="form-control form-control-lg" v-model="tipoPago">
                                    <option value="0" disabled>Seleccione</option>
                                    <option value="contado">Contado</option>
                                    <option value="credito">Credito</option>
                                </select><br>
                            </div>
                            <!--Credito-->
                            <template v-if="tipoPago=='credito'">
                                <div class="col-md-12"><br>
                                    <div class="form-group row border">
                                        <div class="col-md-4">
                                            <label for="">Tipo de Credito</label>
                                            <select class="form-control" v-model="tipoCredito">
                                                <option value="0" disableb>Seleccione</option>
                                                <option value="mensual">Mensual</option>
                                                <option value="semestral">Semestral</option>
                                            </select>
                                            <br>
                                            <label for="">Plazo</label>
                                            <select class="form-control" v-model="plazo">
                                                <option value="0" disableb>Seleccione</option>
                                                <option value="2">2 años</option>
                                                <option value="4">4 años</option>
                                                <option value="5">5 años</option>
                                            </select>
                                            <br>
                                            <label for="">Interes</label>
                                            <input type="number" class="form-control" v-model="interes" placeholder="Interes">
                                            <br>
                                            <label for="">Monto Total</label><br>
                                            <p>{{calcularMontoCredito}}</p>

                                            <center>
                                                <button class="btn btn-primary" type="button" @click="cuota()">Calcular</button>
                                            </center><br>

                                        </div>
                                        <div class="col-md-8">
                                            <label for="">Cuota</label>
                                            <div style="overflow-y: auto; height: 350px;">
                                                <table class="table table-bordered table-sm">
                                                    <thead class="table-info">
                                                        <th>Nro</th>
                                                        <th>fecha</th>
                                                        <th>Total</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="cuota in arrayCuota" :key="cuota.id">
                                                            <td v-text="cuota.nro"></td>
                                                            <td v-text="cuota.fecha"></td>
                                                            <td v-text="cuota.monto"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </template>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarListadoNotaVenta()" class="btn btn-secondary">Cerrar</button>
                                <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardar()">Guardar</button>
                                <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="modificarMedicamento()">Modificar</button>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
            <!-- Fin ejemplo de tabla Listado -->
        </div>
    <!--Modal de Imagen-->
<!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalImagen}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <center><h4 class="modal-title">Imagen</h4></center>
                    <button type="button" class="close" @click="cerrarModalImagen()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <center>
                            <figure><img width="200" height="200" :src="imagenMin" alt="Foto del Propiedad"></figure>
                        </center>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="imagen">Foto</label>
                            <div class="col-md-9">
                                <input type="file" @change="obtenerImagen" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="email-input">Descripcion</label>
                            <div class="col-md-9">
                                <textarea class="form-control" v-model="descripcionFoto" rows="3"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalImagen()">Cerrar</button>
                    <button type="button" class="btn btn-primary" @click="agregarFoto()">Agregar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
   <!--Fin del modal-->
<!--Modal de Cliente-->
<!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalCliente}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Cliente</h4>
                        <button type="button" class="close" @click="cerrarModalCliente()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterioCliente">
                                    <option value="nombre">Nombre</option>
                                    <option value="apellidos">Apellidos</option>
                                    <option value="razonSocial">Razon Social</option>
                                </select>
                                <input type="text" v-model="buscarCliente" @keyup.enter="listarCliente(criterioCliente,buscarCliente)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarCliente(criterioCliente,buscarCliente)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Tipo</th>
                                        <th>Cedula Identidad</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Razon Social</th>
                                        <th>Correo Electronico</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cliente in arrayCliente" :key="cliente.id">
                                        <td>
                                            <button type="button" @click="seleccionarCliente(cliente)" class="btn btn-primary btn-sm">
                                            <i class="icon-check"></i>
                                            </button>
                                        </td>
                                        <td v-text="cliente.tipo"></td>
                                        <td v-text="cliente.ci"></td>
                                        <td v-text="cliente.nombre"></td>
                                        <td v-text="cliente.apellidos"></td>
                                        <td v-text="cliente.razonSocial"></td>
                                        <td v-text="cliente.correo"></td>
                                        <td v-text="cliente.telefono"></td>
                                        <td v-text="cliente.direccion"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalCliente()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!--Fin del modal-->
 <!--modal agregar/Nuevo Cliente-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalNuevoCliente}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                        <h4 class="modal-title">Agregar Cliente</h4>
                    <button type="button" class="close" @click="cerrarModalNuevoCliente()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Seleccione Un Tipo</label>
                            <div class="col-md-9">
                                <select  class="form-control" v-model="datosTipo">
                                    <option value="0" disableb="">Seleccione...</option>
                                    <option value="persona">Persona</option>
                                    <option value="empresa">Empresa</option>
                                </select>
                            </div>
                        </div>

                        <template v-if="datosTipo=='persona'">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Cedula Identidad</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" v-model="datosCi" placeholder="Cedula Identidad">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="datosNombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="datosApellidos" placeholder="Apellidos">
                                </div>
                            </div>
                        </template>

                        <template v-if="datosTipo=='empresa'">
                            <div class="form-group row">
                                <label class="col-md-3 form-control-label" for="text-input">Razon Social</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" v-model="datosRazonSocial" placeholder="Razon social">
                                </div>
                            </div>
                        </template>

                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" v-model="datosDireccion" placeholder="Direccion">
                                    </div>
                        </div>

                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Correo Electronico</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" v-model="datosCorreo" placeholder="email@example.com">
                                    </div>
                        </div>
                        <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" v-model="datosTelefono" placeholder="Telefono">
                                    </div>
                        </div>

                        <!--<div v-show="errorCliente" class="form-group row div-error">
                            <div class="text-center text-error">
                                <div v-for="error in errorMostrarMsjCliente" :key="error" v-text="error">

                                </div>
                            </div>
                        </div>
                        -->
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalNuevoCliente()">Cerrar</button>
                    <button type="button" class="btn btn-primary"  @click="guardarNuevoCliente()">Guardar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!--Fin del modal-->
<!--modal agregar/Ver Propiedad-->
<div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalVerPropiedad}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <center>
                            <h4 class="modal-title" v-text="datosTipo"></h4>
                        </center>
                </div>

                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Descripcion:</label>
                            <div class="col-md-9">
                                <p v-text="datosDescripcion"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Metre Cuadrado:</label>
                            <div class="col-md-9">
                                <p v-text="datosMetro"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nro de Piso:</label>
                            <div class="col-md-9">
                                <p v-text="datosNroPiso"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Fecha Inicio de Construccion:</label>
                            <div class="col-md-9">
                                <p v-text="datosInicioConstruccion"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">fecha Fin de Construccion:</label>
                            <div class="col-md-9">
                                <p v-text="datosFinConstruccion"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Provincia:</label>
                            <div class="col-md-9">
                                <p v-text="datosProvincia"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Municipio:</label>
                            <div class="col-md-9">
                                <p v-text="datosMunicipio"></p>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Ciudad:</label>
                            <div class="col-md-9">
                                <p v-text="datosCiudad"></p>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalVerPropiedad()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div>
<!--Fin-->
        <div class="modal fade" id="modalSlider" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img :src="'img/propiedad/'+slideImagen[0]" class="d-block w-100" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img :src="'img/propiedad/'+slideImagen[1]" class="d-block w-100" alt="...">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Anterior</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Siguiente</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
   //import vSelect from 'vue-select';
    import moment from 'moment';
    export default {
        data(){
            return {
                    idNotaVenta : 0,
                    fecha : moment().format('YYYY-MM-DD'),
                    metroCuadrado : '',
                    tipoPago : '0',
                    montoTotal:0,
                    idPropiedad : 0,
                arrayNotaVenta: [],
                arrayPropiedad : [],
                //imagen
                slideImagen : [],
                arrayImagen:[],
                id:0,
                descripcionFoto:'',
                foto : '',
                imagenMiniatura : '',
                modalImagen : 0,
                tituloModal : '',
                tipoAccion : 0,
                //cliente
                arrayCliente:[],
                modalCliente:0,
                idCliente: 0,
                nombreCliente:'',
                modalNuevoCliente: 0,
                datosTipo:'',
                datosDireccion:'',
                datosTelefono:'',
                datosCi:'',
                datosNombre:'',
                datosApellidos:'',
                datosRazonSocial:'',
                datosCorreo : '',
                //detalle
                idP:'',
                nombreP:'',
                descripcionP:'',
                preciov:0,
                //plan credito
                tipoCredito:'0',
                interes: 0.0,
                plazo:'0',
                //cuota
                arrayCuota : [],
                montoCuota :'0',
                fechaCuota : '',
                errorMostrarMsjNotaVenta : [],
                errorMostrarMsjCliente : [],
                //Propiedad
                datosTipo:'',
                datosDescripcion:'',
                datosMetro:'',
                datosNroPiso:'',
                datosInicioConstruccion:'',
                datosFinConstruccion:'',
                datosProvincia:'',
                datosMunicipio:'',
                datosCiudad:'',
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'notaventa.id',
                buscar : '',
                criterioPropiedad : 'propiedad.codigo',
                buscarCliente : '',
                criterioCliente : 'nombre',
                buscarPropiedad : '',
                listado: 0,
                modalVerPropiedad:0,
                message:'',
            }
        },
        computed : {
            calcularMontoCredito:function(){
                var interesCredito=0.0;
                    interesCredito=this.interes/100;
                    interesCredito=this.preciov * interesCredito;
                var resultado= Number(this.preciov) + interesCredito;
                return resultado;
            },
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }

                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }

                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
            imagenMin(){
                return this.imagenMiniatura;
            }
        },
        methods : {
             cambiarPagina(page,buscar,criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listar(page,buscar,criterio);
            },
            listar(page,buscar,criterio){
                let me=this;
                var url='/notaventa?page=' + page+'&buscar='+buscar+'&criterio='+criterio;
                    axios.get(url).then(function (response){
                    me.arrayNotaVenta=response.data.data;
                    me.pagination={total:response.data.total,
                        current_page:response.data.current_page,
                        per_page: response.data.per_page,
                        last_page: response.data.last_page,
                        from: response.data.from,
                        to: response.data.to
                    }
                })
                .catch(function (error) {
                    console.log(error);
                });
           },
            guardar(){
                let me = this;
                axios.post('/notaventa/guardar',{
                    'fecha':this.fecha,
                    'tipoPago':this.tipoPago,
                    'montoTotal':this.preciov,
                    'idPropiedad':this.idPropiedad,
                    'idCliente':this.idCliente,
                    'interes':this.interes,
                    'plazo':this.plazo,
                    'tipoCredito':this.tipoCredito,
                    'data':this.arrayCuota
                }).then(function (response) {
                    me.listado = 1;
                    me.listar(1, '', 'fecha');
                    me.arrayNotaVenta = [];
                    me.limpiar();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            obtenerImagen(e){
                let me=this;
                var fileReader = new FileReader();
                fileReader.readAsDataURL(e.target.files[0]);
                fileReader.onload = e => {
                    me.foto = e.target.result;
                    me.imagenMiniatura=me.foto;
                };
            },
            agregarFoto(){
                let me = this;
                me.arrayImagen.push({
                    foto : me.foto,
                    descripcionFoto : me.descripcionFoto
                });
                me.id = 0,
                me.foto = '',
                me.descripcionFoto = ''

                me.imagenMiniatura = '';
            },
            eliminar(id){
                    swal({
                title: 'Esta seguro de Desactivar esta Nota Venta?',
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar!',
                cancelButtonText: 'Cancelar',
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger',
                buttonsStyling: false,
                reverseButtons: true
                }).then((result) => {
                if (result.value) {
                    let me = this;
                    axios.put('/notaventa/desactivar/'+id).then(function (response) {
                        me.listar(1,'','fecha');
                        swal(
                        'Desactivado!',
                        'El registro ha sido eliminado con éxito.',
                        'success'
                        )
                    }).catch(function (error) {
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                }
                })
            },
            limpiar(){

                this.idCliente='';
                this.nombreCliente='';

                this.tipoPago='0';
                this.montoTotal=0;
                this.preciov=0;
                this.idPropiedad=0;
                this.nombreP='';
                this.tipo='0';
                this.idPropiedad=0;
                this.idCliente=0;
                this.tipoCredito='0';
                this.plazo='0';
                this.interes=0;
                this.arrayCliente=[];
                this.arrayCuota=[];
            },
            abrirNotaVenta(){
                this.tipoAccion=1;
                this.listado=1;
            },
            ocultarListadoNotaVenta(){
                this.listado=0;
                this.limpiar();
            },
            //Propiedad
            listarPropiedad(buscar, criterio){
                let me=this;
                var url='/propiedad?buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayPropiedad=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            verPropiedad(data=[]){
                this.modalVerPropiedad=1;
                this.datosTipo=data['tipo'];
                this.datosDescripcion=data['descripcion'];
                this.datosMetro=data['metroCuadrado'];
                this.datosNroPiso=data['nroPiso'];
                this.datosInicioConstruccion=data['inicioConstruccion'];
                this.datosFinConstruccion=data['finConstruccion'];
                this.datosProvincia=data['provincia'];
                this.datosMunicipio=data['municipio'];
                this.datosCiudad=data['ciudad'];
            },
            cerrarModalVerPropiedad(){
                this.modalVerPropiedad=0;
                this.limpiarDatos();
            },
            limpiarDatos(){
                this.datosTipo='';
                this.datosDescripcion='';
                this.datosMetro='';
                this.datosNroPiso='';
                this.datosInicioConstruccion='';
                this.datosFinConstruccion='';
                this.datosProvincia='';
                this.datosMunicipio='';
                this.datosCiudad='';
            },
            agregarPropiedad(data=[]){
                let me = this;
                me.idPropiedad =data['id'];
                me.nombreP = data['tipo'];
                me.preciov = data['precio'];
            },
            eliminarPropiedad(){
                let me=this;
                me.idPropiedad='';
                me.nombreP='';
                me.descripcionP='';
                me.preciov=0;
            },
            //nuevo Cliente
            abrirModalNuevoCliente(){
                this.modalNuevoCliente = 1;
            },
            cerrarModalNuevoCliente(){
                this.modalNuevoCliente=0;
            },
            guardarNuevoCliente(){
                let me = this;
                axios.post('/cliente/guardar',{
                    'direccion':this.datosDireccion,
                    'correo':this.datosCorreo,
                    'telefono':this.datosTelefono,
                    'tipo':this.datosTipo,
                    'ci':this.datosCi,
                    'nombre':this.datosNombre,
                    'apellidos':this.datosApellidos,
                    'razonSocial':this.datosRazonSocial
                }).then(function (response) {
                    me.limpiarCliente();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            limpiarCliente(){
                this.datosDireccion='';
                this.datosCorreo='';
                this.datosTelefono='';
                this.datosTipo='';
                this.datosNombre='';
                this.datosApellidos='';
                this.datosRazonSocial='';
                this.datosCi='';
                this.modalNuevoCliente=0;
            },
            abrirModalCliente(){
                this.modalCliente = 1;
            },
            cerrarModalCliente(){
                this.modalCliente=0;
            },
            //imagen
            abrirModalImagen(modelo,accion,data=[]){
                this.modalImagen = 1;
            },
            cerrarModalImagen(){
                this.modalImagen = 0;
            },
            sliderImagen(id){
                let me=this;
                me.slideImagen=[];
                var url='/imagen/slider?id=' + id;
                var data =[];
                var slider = [];
                axios.get(url).then(function(response){
                    me.slideImagen=response.data;
                    for(var i=0;i<data.length;i++){
                        slider.push('/img/propiedad/'+data[i]);
                    }
                })
                .catch(function(error){
                    console.log(error)
                });
                this.slideImagen=slider;
            },
            //Cliente
            listarCliente(){
                let me=this;
                var url='/cliente/listado?criterio='+this.criterioCliente+'&buscar='+this.buscarCliente;
                axios.get(url).then(function(response){
                    me.arrayCliente=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            seleccionarCliente(data=[]){
                this.idCliente = data['id'];
                if(data['tipo']=='empresa'){
                    this.nombreCliente=data['razonSocial']
                }else{
                    this.nombreCliente = data['nombre'] + " " + data['apellidos'];
                }
                this.cerrarModalCliente();
            },
            //cuota
            cuota(){
                let me=this;
                var mensual=this.tipoCredito;
                var plazoCredito=this.plazo;
                var monto;
                var porcentaje;
                    porcentaje= me.interes/100;
                var interes=me.preciov * porcentaje;

                //para convertir un string a datos numericos
                    monto = Number(me.preciov);
                    monto = monto + interes;

                var fechaMes = moment().format('YYYY-MM-DD');
                if(me.tipoCredito=='mensual'){
                    me.arrayCuota=[];
                    plazoCredito=plazoCredito * 12;
                    monto = (monto / plazoCredito).toFixed(2);

                    for (let i = 0; i < plazoCredito; i++) {
                        fechaMes = moment().add(i, 'M').format('YYYY-MM-DD');
                        me.arrayCuota.push({
                            nro  : i+1,
                            fecha : fechaMes,
                            monto : monto
                        });
                    }
                }else{
                    if(me.tipoCredito='semestral'){
                        me.arrayCuota=[];
                        plazoCredito=plazoCredito * 2;
                        monto = (monto / plazoCredito).toFixed(2);
                        var contadorSemestral = 0;

                        for (let i = 0; i < plazoCredito; i++) {
                            fechaMes = moment().add(contadorSemestral, 'M').format('YYYY-MM-DD');
                            contadorSemestral=contadorSemestral + 6;
                            me.arrayCuota.push({
                                nro  : i + 1,
                                fecha : fechaMes,
                                monto : monto
                            });
                        }
                    }
                }
            },
        },
        mounted() {
            this.listar(1, this.buscar, this.criterio);
            //this.listarPropiedad(this.buscarPropiedad, this.criterioPropiedad);

        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: list-item !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #3c29297a !important;
    }
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
</style>
