<template>
    <main class="main">
        <div class="container-fluid">
            <!-- Ejemplo de tabla Listado -->
            <div class="card">
                <div class="card-header">
                    <i class="fa fa-align-justify"></i> Propiedad
                    <button type="button" @click="abrirPropiedad()" class="btn btn-secondary">
                        <i class="icon-plus"></i>&nbsp;Nuevo
                    </button>
                </div>

                <!-- Listado y busqueda de Propiedad -->
                <template v-if="listado2==4">
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="propiedad.codigo">Codigo</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listar(buscar, criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listar(buscar, criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                            <div class="card-deck">
                                <div class="col-md-3" v-for="propiedad in arrayPropiedad" :key="propiedad.id">
                                    <div class="card">  
                                        <center>
                                            <template v-if="propiedad.estado=='disponible'">
                                                <font size="5" face="Times New Roman"><span class="badge badge-success">Disponible</span></font>
                                            </template>
                                            <template v-if="propiedad.estado=='mantenimiento'">
                                                <font size="5" face="Times New Roman"><span class="badge badge-primary">Mantenimiento</span></font>
                                            </template>
                                              <template v-if="propiedad.estado=='vendido'">
                                                <font size="5" face="Times New Roman"><span class="badge badge-danger">Vendido</span></font>
                                            </template>
                                        </center>
                                        <img :src="'img/photo2.png'" @click="sliderImagen(propiedad.id)" data-toggle="modal" data-target="#modalSlider" class="card-img-top" width="100" height="200" align="left" alt="">
                                       
                                        <div class="card-body">
                                            <center>  
                                                <center>
                                                    <button type="button" class="btn btn-success" @click="verPropiedad(propiedad)"><i class="fa fa-eye"></i>Ver</button>          
                                                </center>
                                                <font size="4" face="Times New Roman"><b>Tipo: </b>{{propiedad.tipo}}</font><br>
                                                <font size="4" face="Times New Roman"><b>Codigo: </b>{{propiedad.codigo}}</font><br>
                                                <font size="4" face="Times New Roman"><b>Precio: </b>{{propiedad.precio}} Bs</font><br>                                                                              
                                            </center>
                                        </div>
                                        <div class="card-footer">                             
                                            <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <template v-if="propiedad.estado=='disponible'">
                                                        <a class="dropdown-item bg-light" href="#" @click="desactivarPropiedad(propiedad.id)"><i class="fa fa-toggle-on text-success"></i>Desactivar</a>    
                                                    </template>
                                                    <template v-if="propiedad.estado=='mantenimiento'">
                                                        <a class="dropdown-item bg-light" href="#" @click="activarPropiedad(propiedad.id)"><i class="fa fa-toggle-off text-danger"></i>Activar</a>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>                                               
                                    </div>
                                </div>
                            </div>
                    </div>
                </template>
                
                <template v-if="listado2==5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-xs-12">
                                <center><h3 v-text="tituloModal"></h3></center>
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                    <div class="form-group row">
                                        <label class="col-md-3 form-control-label" for="email-input">Tipo</label>
                                        <div class="col-md-9">
                                            <select class="form-control" v-model="tipo">
                                                <option value='0' disabled >Selecione un Tipo</option>
                                                <option value="vivienda">Vivienda</option>
                                                <option value="terreno">Terreno</option>                                 
                                            </select>
                                        </div>
                                    </div>  
                                    <template v-if="tipo=='vivienda'">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Codigo</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="codigo" class="form-control" placeholder="Codigo">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="3" v-model="descripcion" placeholder="Descripcion"></textarea>
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">M2</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="metroCuadrado" class="form-control" placeholder="M2">
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Numero de Piso</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="nroPiso" class="form-control" placeholder="Nro de Piso">
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Inicio de Construccion</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="inicioConstruccion" class="form-control">
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Fin de Construccion</label>
                                            <div class="col-md-9">
                                                <input type="date" v-model="finConstruccion" class="form-control">
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Precio de Propiedad</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="precio" class="form-control" placeholder="Precio de Propiedad">
                                            </div>
                                        </div> 
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Propietario</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idPropietario" class="form-control">
                                                    <input type="text" v-model="nombrePropietario" class="form-control">
                                                    <button type="button" @click="abrirModalPropietario()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>    
                                                    <button type="button" @click="abrirModalNuevoPropietario()" class="btn btn-secondary">Nuevo</button>
                                                </div>
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Localidad</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idLocalidad" class="form-control">
                                                    <input type="text" v-model="nombreLocalidad" class="form-control">
                                                    <button type="button" @click="abrirModalLocalidad()" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>
                                                    <button type="button" class="btn btn-secondary">Nuevo</button>        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Agente</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idAgente" class="form-control">
                                                    <input type="text" v-model="nombreAgente" class="form-control">
                                                    <button type="button" @click="abrirModalAgente()" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>        
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="imagen">Foto</label>
                                            <div class="col-md-9">
                                                <button type="button" class="btn btn-success" @click="abrirModalImagen()"><i class="fa fa-file-image"></i> Añadir Imagen</button>
                                            </div>                                
                                        </div>
                                    </template>
                                    
                                    <template v-if="tipo=='terreno'">
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Codigo</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="codigo" class="form-control" placeholder="Codigo">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Descripcion</label>
                                            <div class="col-md-9">
                                                <textarea class="form-control" rows="3" v-model="descripcion" placeholder="Descripcion"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">M2</label>
                                            <div class="col-md-9">
                                                <input type="text" v-model="metroCuadrado" class="form-control" placeholder="M2">
                                            </div>
                                        </div>
                                
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="text-input">Precio de Propiedad</label>
                                            <div class="col-md-9">
                                                <input type="number" v-model="precio" class="form-control" placeholder="Precio de Propiedad">
                                            </div>
                                        </div> 
                                    
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Propietario</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idPropietario" class="form-control">
                                                    <input type="text" v-model="nombrePropietario" class="form-control">
                                                    <button type="button" @click="abrirModalPropietario()" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>    
                                                    <button type="button" @click="abrirModalNuevoPropietario()" class="btn btn-secondary">Nuevo</button>
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Localidad</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idLocalidad" class="form-control">
                                                    <input type="text" v-model="nombreLocalidad" class="form-control">
                                                    <button type="button" @click="abrirModalLocalidad()" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>
                                                    <button type="button" class="btn btn-secondary">Nuevo</button>        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="email-input">Agente</label>
                                            <div class="col-md-9">
                                                <div class="input-group">
                                                    <input type="hidden" v-model="idAgente" class="form-control">
                                                    <input type="text" v-model="nombreAgente" class="form-control">
                                                    <button type="button" @click="abrirModalAgente()" class="btn btn-primary"><i class="fa fa-search"></i>Buscar</button>        
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-md-3 form-control-label" for="imagen">Foto</label>
                                            <div class="col-md-9">
                                                <button type="button" class="btn btn-success" @click="abrirModalImagen()"><i class="fa fa-file-image"></i> Añadir Imagen</button>
                                            </div>                                
                                        </div>
                                    </template>

                                    <div v-show="errorMostrarMsjPropiedad" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjPropiedad" :key="error" v-text="error">

                                            </div>
                                        </div>
                                    </div>
                                </form>
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
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="button" @click="ocultarListadoPropiedad()" class="btn btn-secondary">Cerrar</button>
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
 <!--Modal de Localidad-->
<!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalLocalidad}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Localidad</h4>
                        <button type="button" class="close" @click="cerrarModalLocalidad()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterioLocalidad">
                                    <option value="provincia">Provincia</option>
                                    <option value="municipio">Municipio</option>
                                    <option value="ciudad">Ciudad</option>
                                </select>
                                <input type="text" v-model="buscarLocalidad" @keyup.enter="listarLocalidad(criterioLocalidad,buscarLocalidad)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarLocalidad(criterioLocalidad,buscarLocalidad)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Provincia</th>
                                        <th>Municipio</th>
                                        <th>Ciudad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="localidad in arrayLocalidad" :key="localidad.id">
                                        <td>
                                            <button type="button" @click="seleccionarLocalidad(localidad)" class="btn btn-primary btn-sm">
                                            <i class="icon-check"></i>
                                            </button>
                                        </td>
                                        <td v-text="localidad.provincia"></td>
                                        <td v-text="localidad.municipio"></td>
                                        <td v-text="localidad.ciudad"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalLocalidad()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!--Fin del modal-->

<!--Modal de Localidad-->
<!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalPropietario}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Propietario</h4>
                        <button type="button" class="close" @click="cerrarModalPropietario()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterioPropietario">
                                    <option value="ci">cedula</option>
                                    <option value="paterno">Paterno</option>
                                </select>
                                <input type="text" v-model="buscarPropietario" @keyup.enter="listarPropietario(criterioPropietario,buscarPropietario)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarPropietario(criterioPropietario,buscarPropietario)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Cedula Identidad</th>
                                        <th>Nombre</th>
                                        <th>Paterno</th>
                                        <th>Materno</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="propietario in arrayPropietario" :key="propietario.id">
                                        <td>
                                            <button type="button" @click="seleccionarPropietario(propietario)" class="btn btn-primary btn-sm">
                                            <i class="icon-check"></i>
                                            </button>
                                        </td>
                                        <td v-text="propietario.ci"></td>
                                        <td v-text="propietario.nombre"></td>
                                        <td v-text="propietario.paterno"></td>
                                        <td v-text="propietario.materno"></td>
                                        <td v-text="propietario.telefono"></td>
                                        <td v-text="propietario.direccion"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalPropietario()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!--Fin del modal-->

 <!--modal agregar/Nuevo Propietario-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalNuevoPropietario}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                        <h4 class="modal-title">Agregar Propietario</h4>
                    <button type="button" class="close" @click="cerrarModalNuevoPropietario()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Cedula Identidad</label>  
                            <div class="col-md-9">
                                <input type="number" class="form-control" v-model="nuevoCi" placeholder="Cedula Identidad">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Nombre</label>  
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="nuevoNombre" placeholder="Nombre">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Paterno</label>  
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="nuevoPaterno" placeholder="Paterno">
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Materno</label>  
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="nuevoMaterno" placeholder="Materno">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Telefono</label>  
                            <div class="col-md-9">
                                <input type="number" class="form-control" v-model="nuevoTelefono" placeholder="Telefono">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-md-3 form-control-label" for="text-input">Direccion</label>  
                            <div class="col-md-9">
                                <input type="text" class="form-control" v-model="nuevoDireccion" placeholder="Direccion">
                            </div>
                        </div>        
                    </form>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalNuevoPropietario()">Cerrar</button>
                    <button type="button" class="btn btn-primary"  @click="guardarNuevoPropietario()">Guardar</button>
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

<!--Modal de Localidad-->
<!--Inicio del modal agregar/actualizar-->
    <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modalAgente}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-primary modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                        <h4 class="modal-title">Agente</h4>
                        <button type="button" class="close" @click="cerrarModalAgente()" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                </div>
                    <div class="modal-body">
                        <div class="form-group row">
                        <div class="col-md-6">
                            <div class="input-group">
                                <select class="form-control col-md-3" v-model="criterioPropietario">
                                    <option value="ci">cedula</option>
                                    <option value="Apellidos">Apellidos</option>
                                </select>
                                <input type="text" v-model="buscarAgente" @keyup.enter="listarAgente(criterioAgente,buscarAgente)" class="form-control" placeholder="Texto a buscar">
                                <button type="submit" @click="listarAgente(criterioAgente,buscarAgente)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th>Opciones</th>
                                        <th>Cedula Identidad</th>
                                        <th>Nombre</th>
                                        <th>Apellidos</th>
                                        <th>Telefono</th>
                                        <th>Direccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="agente in arrayAgente" :key="agente.id">
                                        <td>
                                            <button type="button" @click="seleccionarAgente(agente)" class="btn btn-primary btn-sm">
                                            <i class="icon-check"></i>
                                            </button>
                                        </td>
                                        <td v-text="agente.ci"></td>
                                        <td v-text="agente.nombre"></td>
                                        <td v-text="agente.apellidos"></td>
                                        <td v-text="agente.telefono"></td>
                                        <td v-text="agente.direccion"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>    
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="cerrarModalAgente()">Cerrar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<!--Fin del modal-->
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
    export default {
        data(){
            return {
                    idPropiedad : 0,
                    codigo : '',
                    descripcion : '',
                    metroCuadrado : '',
                    nroPiso : '',
                    inicioConstruccion:'',
                    finConstruccion : '',
                    tipo : '',
                    precio:'',
                    idLocalidad : '',   
                    idPropietario:'',
                    idAgente:'',
                    nombreAgente:'',
                    modalAgente: 0 ,
                    //nuevo propietario
                    nuevoCi:'',
                    nuevoNombre:'',
                    nuevoPaterno:'',
                    nuevoMaterno:'',
                    nuevoTelefono:'',
                    nuevoDireccion:'',
                    modalNuevoPropietario:0,
                arrayPropiedad : [],
                arrayPropietario : [],
                arrayLocalidad:[],
                slideImagen : [],
                arrayImagen:[],
                id:0,
                descripcionFoto:'', 
                foto : '',
                imagenMiniatura : '',
                modalImagen : 0,
                modalLocalidad: 0,
                tituloModal : '',
                tipoAccion : 0,
                datosTipo:'',
                datosDescripcion:'',
                datosMetro:'',
                datosInicioConstruccion:'',
                datosFinConstruccion:'',
                datosNroPiso:'',
                datosProvincia:'',
                datosMunicipio:'',
                datosCiudad:'',
                errorMostrarMsjPropiedad : [],
                offset : 3,
                criterio : 'propiedad.codigo',
                buscar : '',
                buscarLocalidad : '',
                criterioLocalidad : 'provincia',
                listado2: 4,
                nombreLocalidad : '',
                buscarPropietario : '',
                criterioPropietario : 'ci',
                nombrePropietario : '',
                buscarAgente:'',
                criterioAgente:'ci',
                arrayAgente:[],
                modalPropietario : 0,
                modalVerPropiedad:0,
                message:'',
            }
        },
        // components : {
        //    vSelect
        //},
        computed : {
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
            listar(buscar, criterio){
                let me=this;
                var url='/propiedad?buscar='+ buscar + '&criterio=' + criterio;
                axios.get(url).then(function(response){
                    me.arrayPropiedad=response.data;
                })
                .catch(function(error){
                    console.log(error)
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
            guardar(){
                let me = this;
                axios.post('/propiedad/guardar',{
                    'codigo': this.codigo,
                    'descripcion':this.descripcion,
                    'metroCuadrado':this.metroCuadrado,
                    'nroPiso':this.nroPiso,
                    'inicioConstruccion':this.inicioConstruccion,
                    'finConstruccion':this.finConstruccion,
                    'precio':this.precio,
                    'tipo':this.tipo,
                    'idPropietario':this.idPropietario,
                    'idLocalidad':this.idLocalidad,
                    'idAgente':this.idAgente,
                    'data':this.arrayImagen
                }).then(function (response) {
                    me.listado2 = 4;
                    me.listar('', 'descripcion');
                    me.arrayPropiedad = [];
                    me.limpiar();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            /*modificar(){
                let me = this;
                axios.put('/medicamento/modificar',{
                    'id':this.laboratorioId,
                    'nombre':this.nombreM,
                    'accionTerapeutica':this.accionTerapeutica,
                    'precio1':this.precio1,
                    'precio2':this.precio2,
                    'fechaVcto':this.fechaVcto,
                    'foto':this.foto,
                    'idLaboratorio':this.idLaboratorio,
                    'idCategoria':this.idCategoria
                }).then(function (response) {
                    me.listado2 =4;
                    me.listarMedicamento('', '', 'nombre');
                    me.arrayMedicamento = [];
                    me.arraySub = [];
                    me.arrayLaboratorio = [];
                    me.limpiar();
                }).catch(function (error) {
                    console.log(error);
                });
            },*/
            desactivarPropiedad(id){
               swal({
                title: 'Esta seguro de desactivar esta Propiedad?',
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
                    axios.put('/propiedad/desactivar',{'id': id}).then(function (response) {
                        me.listar('','codigo');
                        swal(
                        'Desactivado!',
                        'El registro ha sido desactivado con éxito.',
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
            activarPropiedad(id){
               swal({
                title: 'Esta seguro de activar esta Propiedad?',
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
                    axios.put('/propiedad/activar',{'id': id}).then(function (response) {
                        me.listar('','codigo');
                        swal(
                        'Desactivado!',
                        'El registro ha sido activado con éxito.',
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
                this.codigo='';
                this.descripcion='';
                this.metroCuadrado='';
                this.nroPiso=0;
                this.idAgente=0;
                this.nombreAgente='';
                this.inicioConstruccion=0;
                this.finConstruccion='';
                this.tipo='';
                this.precio='';
                this.idLocalidad=0;
                this.idPropietario='';
                this.nombrePropietario='';
                this.nombreLocalidad='';
                this.arrayPropietario=[];
                this.arrayLocalidad=[];
                this.arrayImagen=[];
                this.descripcionFoto='';
                this.foto='';
                this.id=0;
            },
            ocultarListadoPropiedad(){
                this.listado2=4;
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
        
            //nuevo Propietario
            abrirModalNuevoPropietario(){
                this.modalNuevoPropietario = 1;
            },
            cerrarModalNuevoPropietario(){
                this.modalNuevoPropietario=0;
            },
            guardarNuevoPropietario(){
                let me = this;
                axios.post('/propietario/guardar',{
                    'ci':this.nuevoCi,
                    'nombre':this.nuevoNombre,
                    'paterno':this.nuevoPaterno,
                    'materno':this.nuevoMaterno,
                    'telefono':this.nuevoTelefono,
                    'direccion':this.nuevoDireccion
                }).then(function (response) {
                    me.limpiarPropietario();
                }).catch(function (error) {
                    console.log(error);
                });
            },
            limpiarPropietario(){
                let me=this;
                me.nuevoCi='';
                me.nuevoNombre='';
                me.nuevoPaterno='';
                me.nuevoMaterno='';
                me.nuevoTelefono='';
                me.nuevoDireccion='';
                me.modalNuevoPropietario=0;
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
            abrirPropiedad(){
                let me = this;
                me.listado2=5;
                me.tituloModal='Registrar Propiedad';
                me.tipoAccion=1;
                me.id = 0;
                me.idPropiedad=0;
                me.idAgente=0;
                me.nombreAgente='';
                me.foto = '';
                me.descripcion = '';
                me.metroCuadrado = '';
                me.nroPiso = '';
                me.inicioConstruccion = '';
                me.finConstruccion='';
                me.tipo = '0';
                me.precio='';
                me.idPropietario = 0;
                me.idLocalidad = 0;
                me.nombreLocalidad='';
                me.nombrePropietario=''
                     
            },
            /*abrirModificarMedicamento(data=[]){
                this.selectLaboratorio();
                let me = this;
                me.listado2=5;
                me.tituloModal='Modificar Medicamento';
                me.tipoAccion=2;
                this.laboratorioId = data['id'];
                this.nombreM = data['nombreMedicamento'];
                this.accionTerapeutica = data['accionTerapeutica'];
                this.precio1 = data['precio1'];
                this.precio2 = data['precio2'];
                this.fechaVcto = data['fechaVcto'];
                this.foto = data['foto'];
                this.imagenMiniatura= 'img/FotoMedicamentos/'+this.foto;
                this.idLaboratorio = data['idLaboratorio'];
                this.idCategoria = data['idCategoria'];
                this.nombreSub= data['nombreSub'];
            },*/

            //propietario
            listarPropietario(){
                let me=this;
                var url='/propietario/listado?criterio='+this.criterioPropietario+'&buscar='+this.buscarPropietario;
                axios.get(url).then(function(response){
                    me.arrayPropietario=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            abrirModalPropietario(){
                this.modalPropietario = 1; 
            },
            cerrarModalPropietario(){
                this.modalPropietario = 0; 
            },
            seleccionarPropietario(data=[]){
                this.idPropietario = data['id'];
                this.nombrePropietario = data['nombre'] + " " + data['paterno'];
                this.cerrarModalPropietario();
            },

            //localidad
            abrirModalLocalidad(){
                this.modalLocalidad = 1; 
            },
            cerrarModalLocalidad(){
                this.modalLocalidad=0;
            },
            listarLocalidad(){
                let me=this;
                var url='/localidad/listado?criterio='+this.criterioLocalidad+'&buscar='+this.buscarLocalidad;
                axios.get(url).then(function(response){
                    me.arrayLocalidad=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            seleccionarLocalidad(data=[]){
                this.idLocalidad = data['id'];
                this.nombreLocalidad = data['provincia'];
                this.cerrarModalLocalidad();
            },
            //Agente
            abrirModalAgente(){
                this.modalAgente = 1; 
            },
            cerrarModalAgente(){
                this.modalAgente=0;
            },
            listarAgente(){
                let me=this;
                var url='/agente/listado?criterio='+this.criterioAgente+'&buscar='+this.buscarAgente;
                axios.get(url).then(function(response){
                    me.arrayAgente=response.data;
                })
                .catch(function(error){
                    console.log(error)
                });
            },
            seleccionarAgente(data=[]){
                this.idAgente = data['id'];
                this.nombreAgente = data['nombre'] + data['apellidos'];
                this.cerrarModalAgente();
            },
        },
        mounted() {
            this.listar(this.buscar, this.criterio);
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