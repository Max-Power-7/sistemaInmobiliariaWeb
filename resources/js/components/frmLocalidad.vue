<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Localidad
                        <button type="button" @click="abrirModal('localidad','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                        <option value="provincia">Provincia</option>
                                        <option value="municipio">Municipio</option>
                                        <option value="ciudad">Ciudad</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarLocalidad(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarLocalidad(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Provincia</th>
                                    <th>Municipio</th>
                                    <th>Ciudad</th>
                                    <th>Opciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="localidad in arrayLocalidad" :key="localidad.id">
                                    <td v-text="localidad.provincia"></td>
                                    <td v-text="localidad.municipio"></td>
                                    <td v-text="localidad.ciudad"></td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <template v-if="localidad.estado==1">
                                                        <a class="dropdown-item bg-light" href="#" @click="abrirModal('localidad','modificar',localidad)"><i class="fa fa-pencil text-warning"></i>Modificar</a>
                                                        <a class="dropdown-item bg-light" href="#" @click="desactivarLocalidad(localidad.id)"><i class="fa fa-toggle-on text-success"></i>Desactivar</a>    
                                                    </template>
                                                    <template v-else>
                                                        <a class="dropdown-item bg-light" href="#" @click="activarLocalidad(localidad.id)"><i class="fa fa-toggle-off text-danger"></i>Activar</a>
                                                    </template>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="localidad.estado==1">
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
                                    <label class="col-md-3 form-control-label" for="text-input">Provincia</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="provincia" class="form-control" placeholder="Ingrese una Provincia">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Municipio</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="municipio" class="form-control" placeholder="Ingrese una Municipio">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                    <label class="col-md-3 form-control-label" for="text-input">Ciudad</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="ciudad" class="form-control" placeholder="Ingrese una Ciudad">
                                    </div>
                                </div>
                                                               
                                <div v-show="errorLocalidad" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjLocalidad" :key="error" v-text="error">
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
                localidadId:0,
                provincia:'',
                municipio:'',
                ciudad:'',
                arrayLocalidad:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorLocalidad:0,
                message : '',
                errorMostrarMsjLocalidad:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'provincia',
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
           listarLocalidad(page,buscar,criterio){
                let me=this;
                    var url='/localidad?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                    axios.get(url).then(function (response) {
                    me.arrayLocalidad=response.data.data;
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
                me.listarLocalidad(page,buscar,criterio);
            },
           guardar(){
               if(this.validar()){
                   return; 
               }
            let me = this;
                axios.post('/localidad/guardar',{
                    'provincia':this.provincia,
                    'municipio':this.municipio,
                    'ciudad':this.ciudad
                }).then(function(response){
                    me.cerrarModal();
                    me.listarLocalidad(1,'','provincia');           
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
                axios.put('/localidad/modificar',{
                    'id':this.localidadId,
                    'provincia':this.provincia,
                    'municipio':this.municipio,
                    'ciudad':this.ciudad
                }).then(function(response){
                    me.cerrarModal();
                    me.listarLocalidad(1,'','provincia');           
                })
                .catch(function(error){
                    console.log(error);
                });
           },
           desactivarLocalidad(id){
               swal({
                title: 'Esta seguro de desactivar esta Localidad?',
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
                    axios.put('/localidad/desactivar',{'id': id}).then(function (response) {
                        me.listarLocalidad(1,'','provincia');
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
            activarLocalidad(id){
               swal({
                title: 'Esta seguro de activar esta Localidad?',
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
                    axios.put('/localidad/activar',{'id': id}).then(function (response) {
                        me.listarLocalidad(1,'','provincia');
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
               this.errorLocalidad=0;
               this.errorMostrarMsjLocalidad=[];

               if(!this.provincia)this.errorMostrarMsjLocalidad.push('La nombre de la Provincia esta vacia!');
               if(!this.municipio)this.errorMostrarMsjLocalidad.push('El nombre del Municipio esta vacia!');
               if(!this.ciudad)this.errorMostrarMsjLocalidad.push('El nombre de la Ciudad esta vacia!');
               if(this.errorMostrarMsjLocalidad.length)this.errorLocalidad=1;

               return this.errorLocalidad;
           },

           cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.provincia='';
                this.municipio='';
                this.ciudad='';
           },
           abrirModal(model,accion,data=[]){
               switch (model) {
                   case 'localidad':
                       {
                           switch(accion){
                               case 'registrar':
                                   {
                                        this.modal=1;
                                        this.tituloModal='Registrar Localida';
                                        this.provincia='';
                                        this.municipio='';
                                        this.ciudad='';
                                        this.tipoAccion=1;
                                         break;
                                   }
                                case 'modificar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Actualizar Localidad';
                                        this.tipoAccion=2;
                                        this.localidadId=data['id'];
                                        this.provincia=data['provincia'];
                                        this.municipio=data['municipio'];
                                        this.ciudad=data['ciudad'];
                                    }   
                           }
                       }
               }
           },
       },
        mounted() {
            this.listarLocalidad(1,this.buscar,this.criterio);
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