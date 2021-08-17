<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Empleado
                        <button type="button" @click="abrirModal('empleado','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="ci">Cedula Identidad</option>
                                      <option value="nombre">Nombre</option>
                                      <option value="apellidos">Apellidos</option>
                                      <option value="telefono">Telefono</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarEmpleado(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarEmpleado(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Cedula Identidad</th>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Opciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="empleado in arrayEmpleado" :key="empleado.id">
                                    <td v-text="empleado.ci"></td>
                                    <td v-text="empleado.nombre"></td>
                                    <td v-text="empleado.apellidos"></td>
                                    <td v-text="empleado.fecha_nacimiento"></td>
                                    <td v-text="empleado.telefono"></td>
                                    <td v-text="empleado.direccion"></td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <template v-if="empleado.estado=='1'">
                                                        <a class="dropdown-item bg-light" href="#" @click="abrirModal('empleado','modificar',empleado)"><i class="icon-pencil text-warning"></i>Modificar</a>
                                                        <a class="dropdown-item bg-light" href="#" @click="desactivarEmpleado(empleado.id)"><i class="fa fa-toggle-on text-success"></i>Desactivar</a>    
                                                    </template>
                                                    <template v-else>
                                                        <a class="dropdown-item bg-light" href="#" @click="activarEmpleado(empleado.id)"><i class="fa fa-toggle-off text-danger"></i>Activar</a>
                                                    </template>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="empleado.estado=='1'">
                                                <span class="badge badge-success">Activo</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge badge-danger">Desactivo</span>
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
                </div>
                <!-- Fin ejemplo de tabla Listado -->
            </div>

            <!--Inicio del modal agregar/actualizar-->
            <div class="modal fade" id="modalNuevo" tabindex="-1" :class="{'mostrar':modal}" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-primary modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-header">

                            <h4 class="modal-title" v-text="tituloModal"></h4>
                            <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                              <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        
                        <div class="modal-body">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Cedula Identidad</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="ci" class="form-control" placeholder="Ingrese Cedula Identidad">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese Nombre">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="apellidos" class="form-control" placeholder="Ingrese Apellidos">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Fecha Nacimiento</label>
                                    <div class="col-md-9">
                                        <input type="date" v-model="fecha_nacimiento" class="form-control" placeholder="Ingrese Fecha de Nacimiento">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                    <div class="col-md-9">
                                        <input type="number" v-model="telefono" class="form-control" placeholder="Ingrese Telefono">
                                    </div>
                                </div>
                        
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="direccion" class="form-control" placeholder="Ingrese Direccion">
                                    </div>
                                </div>
                                           
                                <div v-show="errorEmpleado" class="form-group row div-error">
                                    <div class="text-center text-error">
                                        <div v-for="error in errorMostrarMsjEmpleado" :key="error" v-text="error">
                                        </div>    
                                    </div>
                                </div>

                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardar()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizar()">Modificar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!--Fin del modal-->
        </main>
</template>

<script>
    export default {
        data(){
            return {
                empleadoId:0,
                ci:'',
                nombre:'',
                apellidos:'',
                fecha_nacimiento:'',
                telefono:'',
                direccion:'',
                arrayEmpleado:[],
                modal:0,
                tituloModal:'',
                errorEmpleado:0,
                tipoAccion:0,
                message : '',
                errorMostrarMsjEmpleado:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'ci',
                buscar : '',
            }
        },
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
            }
        },
       methods: {           
           listarEmpleado(page,buscar,criterio){
                let me=this;
                    var url='/empleado?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                    axios.get(url).then(function (response) {
                    me.arrayEmpleado=response.data.data;
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

           cambiarPagina(page,buscar,criterio){
                let me=this;
                me.pagination.current_page=page;
                me.listarEmpleado(page,buscar,criterio);
            },

           guardar(){
               if(this.validar()){
                   return; 
                }
            let me = this;
                axios.post('/empleado/guardar',{
                    'ci':this.ci,
                    'nombre':this.nombre,
                    'apellidos':this.apellidos,
                    'fecha_nacimiento':this.fecha_nacimiento,
                    'telefono':this.telefono,
                    'direccion':this.direccion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEmpleado(1,'','ci');           
                })
                .catch(function(error){
                    console.log(error);
                });   
           },

           actualizar(){
                if(this.validar()){
                   return; 
                }
                let me = this;
                axios.put('/empleado/modificar',{
                    'id':this.empleadoId,
                    'ci':this.ci,
                    'nombre':this.nombre,
                    'apellidos':this.apellidos,
                    'fecha_nacimiento':this.fecha_nacimiento,
                    'telefono':this.telefono,
                    'direccion':this.direccion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarEmpleado(1,'','ci');           
                })
                .catch(function(error){
                    console.log(error);
                });
           },

           desactivarEmpleado(id){
               swal({
                title: 'Esta seguro de desactivar este Empleado?',
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
                    axios.put('/empleado/desactivar',{'id': id}).then(function (response) {
                        me.listarEmpleado(1,'','ci');
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

            activarEmpleado(id){
               swal({
                title: 'Esta seguro de activar este Empleado?',
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
                    axios.put('/empleado/activar',{'id': id}).then(function (response) {
                        me.listarEmpleado(1,'','ci');
                        swal(
                        'Activado!',
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

           validar(){
               this.errorEmpleado=0;
               this.errorMostrarMsjEmpleado=[];

               if(!this.ci)this.errorMostrarMsjEmpleado.push('La Cedula Identidad del Empleado esta vacia!');
               if(!this.nombre)this.errorMostrarMsjEmpleado.push('El Nombre del Empleado esta vacia!');
               if(!this.apellidos)this.errorMostrarMsjEmpleado.push('El Apellidos del Empleado esta vacia!');
                    
               if(this.errorMostrarMsjEmpleado.length)this.errorEmpleado=1;

               return this.errorEmpleado;
           },

           cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.ci='';
                this.nombre='';
                this.apellidos='';
                this.fecha_nacimiento='';
                this.telefono='';
                this.direccion='';
                this.errorMostrarMsjEmpleado=[];
           },

           abrirModal(model,accion,data=[]){
               switch (model) {
                   case 'empleado':
                       {
                           switch(accion){
                               case 'registrar':
                                   {
                                        this.modal=1;
                                        this.tituloModal='Registrar Empleado';
                                        this.ci='';
                                        this.nombre='';
                                        this.apellidos='';
                                        this.fecha_nacimiento='';
                                        this.telefono='';
                                        this.direccion='';
                                        this.tipoAccion=1;
                                         break;
                                   }
                                case 'modificar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Actualizar Empleado';
                                        this.tipoAccion=2;
                                        this.empleadoId=data['id'];
                                        this.ci=data['ci'];
                                        this.nombre=data['nombre'];
                                        this.apellidos=data['apellidos'];
                                        this.fecha_nacimiento=data['fecha_nacimiento'];                                       
                                        this.telefono=data['telefono'];
                                        this.direccion=data['direccion'];
                                    }   
                           }
                       }
               }
           },
       },
        mounted() {
            this.listarEmpleado(1,this.buscar,this.criterio);
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
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
        color:red !important;
        font-weight: bold;
    }
</style>