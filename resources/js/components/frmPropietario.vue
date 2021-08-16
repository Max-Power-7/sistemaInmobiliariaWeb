<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Propietario
                        <button type="button" @click="abrirModal('propietario','registrar')" class="btn btn-secondary">
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
                                      <option value="paterno">Paterno Paterno</option>
                                      <option value="materno">Materno Materno</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarPropietario(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarPropietario(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Cedula Identidad</th>
                                    <th>Nombre</th>
                                    <th>Paterno</th>
                                    <th>Materno</th>
                                    <th>Telefono</th>
                                    <th>Direccion</th>
                                    <th>Opciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="propietario in arrayPropietario" :key="propietario.id">
                                    <td v-text="propietario.ci"></td>
                                    <td v-text="propietario.nombre"></td>
                                    <td v-text="propietario.paterno"></td>
                                    <td v-text="propietario.materno"></td>
                                    <td v-text="propietario.telefono"></td>
                                    <td v-text="propietario.direccion"></td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <template v-if="propietario.estado==1">
                                                        <a class="dropdown-item bg-light" href="#" @click="abrirModal('propietario','modificar',propietario)"><i class="icon-pencil text-warning"></i>Modificar</a>
                                                        <a class="dropdown-item bg-light" href="#" @click="desactivarPropietario(propietario.id)"><i class="fa fa-toggle-on text-success"></i>Desactivar</a>    
                                                    </template>
                                                    <template v-else>
                                                        <a class="dropdown-item bg-light" href="#" @click="activarPropietario(propietario.id)"><i class="fa fa-toggle-off text-danger"></i>Activar</a>
                                                    </template>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="propietario.estado==1">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido Paterno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="paterno" class="form-control" placeholder="Ingrese Apellido Paterno">
                                    </div>

                                </div>
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Apellido Materno</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="materno" class="form-control" placeholder="Ingrese Apellido Materno">
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
                                                               
                                <div v-show="errorPropietario" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjPropietario" :key="error" v-text="error">
                                            </div>    
                                        </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardarPropietario()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarPropietario()">Modificar</button>
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
                propietarioId:0,
                ci:'',
                nombre:'',
                paterno:'',
                materno:'',
                telefono:'',
                direccion:'',
                arrayPropietario:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorPropietario:0,
                listadoTabla : 0,
                message : '',
                errorMostrarMsjPropietario:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'nombre',
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
           listarPropietario(page,buscar,criterio){
                let me=this;
                    var url='/propietario?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                    axios.get(url).then(function (response) {
                    me.arrayPropietario=response.data.data;
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
                me.listarPropietario(page,buscar,criterio);
            },
           guardarPropietario(){
               if(this.validarPropietario()){
                   return; 
               }
            let me = this;
                axios.post('/propietario/guardar',{
                    'ci':this.ci,
                    'nombre':this.nombre,
                    'paterno':this.paterno,
                    'materno':this.materno,
                    'telefono':this.telefono,
                    'direccion':this.direccion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPropietario(1,'','nombre');           
                })
                .catch(function(error){
                    console.log(error);
                });   
           },
           actualizarPropietario(){
                if(this.validarPropietario()){
                   return; 
                }
                let me = this;
                axios.put('/propietario/modificar',{
                    'id':this.propietarioId,
                    'ci':this.ci,
                    'nombre':this.nombre,
                    'paterno':this.paterno,
                    'materno':this.materno,
                    'telefono':this.telefono,
                    'direccion':this.direccion
                }).then(function(response){
                    me.cerrarModal();
                    me.listarPropietario(1,'','nombre');           
                })
                .catch(function(error){
                    console.log(error);
                });
           },
           desactivarPropietario(id){
               swal({
                title: 'Esta seguro de desactivar este Propietario?',
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
                    axios.put('/propietario/desactivar',{'id': id}).then(function (response) {
                        me.listarPropietario(1,'','nombre');
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
            activarPropietario(id){
               swal({
                title: 'Esta seguro de activar este Propietario?',
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
                    axios.put('/propietario/activar',{'id': id}).then(function (response) {
                        me.listarPropietario(1,'','nombre');
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

           validarPropietario(){
               this.errorPropietario=0;
               this.errorMostrarMsjPropietario=[];

               if(!this.ci)this.errorMostrarMsjPropietario.push('La Cedula Identidad del Propietario esta vacia!');
               if(!this.nombre)this.errorMostrarMsjPropietario.push('El nombre del Propietario esta vacia!');
               if(!this.paterno)this.errorMostrarMsjPropietario.push('El Apellido Paterno del Propietario esta vacia!');
               if(!this.materno)this.errorMostrarMsjPropietario.push('El Apellido Paterno del Propietario esta vacia!');
               if(this.errorMostrarMsjPropietario.length)this.errorPropietario=1;

               return this.errorPropietario;
           },

           cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.ci='';
                this.nombre='';
                this.paterno='';
                this.materno='';
                this.telefono='';
                this.direccion='';
           },
           abrirModal(model,accion,data=[]){
               switch (model) {
                   case 'propietario':
                       {
                           switch(accion){
                               case 'registrar':
                                   {
                                        this.modal=1;
                                        this.tituloModal='Registrar Propietario';
                                        this.ci='';
                                        this.nombre='';
                                        this.paterno='';
                                        this.materno='';
                                        this.telefono='';
                                        this.direccion='';
                                        this.tipoAccion=1;
                                         break;
                                   }
                                case 'modificar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Actualizar Propietario';
                                        this.tipoAccion=2;
                                        this.propietarioId=data['id'];
                                        this.ci=data['ci'];
                                        this.nombre=data['nombre'];
                                        this.paterno=data['paterno'];
                                        this.materno=data['materno'];
                                        this.telefono=data['telefono'];                                       
                                        this.direccion=data['direccion'];
                                    }   
                           }
                       }
               }
           },
       },
        mounted() {
            this.listarPropietario(1,this.buscar,this.criterio);
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