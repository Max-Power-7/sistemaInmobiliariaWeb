<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Categoria
                        <button type="button" @click="abrirModal('categoria','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3">
                                      <option value="nombre">Nombre</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCategoria(1,buscar)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCategoria(1,buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Opciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="categoria in arrayCategoria" :key="categoria.id">
                                    <td v-text="categoria.nombre"></td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <template v-if="categoria.estado==1">
                                                        <a class="dropdown-item bg-light" href="#" @click="abrirModal('categoria','modificar',categoria)"><i class="icon-pencil text-warning"></i>Modificar</a>
                                                        <a class="dropdown-item bg-light" href="#" @click="desactivarCategoria(categoria.id)"><i class="fa fa-toggle-on text-success"></i>Desactivar</a>    
                                                    </template>
                                                    <template v-else>
                                                        <a class="dropdown-item bg-light" href="#" @click="activarCategoria(categoria.id)"><i class="fa fa-toggle-off text-danger"></i>Activar</a>
                                                    </template>
                                                </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div v-if="categoria.estado==1">
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
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,buscar)">Ant</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page==isActived ? 'active' :'']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page,buscar)" v-text="page">1</a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,buscar)">Sig</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                    <div class="col-md-9">
                                        <input type="text" v-model="nombre" class="form-control" placeholder="Ingrese Nombre">
                                    </div>
                                </div>
                                                               
                                <div v-show="errorCategoria" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjCategoria" :key="error" v-text="error">
                                            </div>    
                                        </div>
                                </div>
                            </form>
                        </div>
                        
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardarCategoria()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="actualizarCategoria()">Modificar</button>
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
                categoriaId:0,
                nombre:'',
                arrayCategoria:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorCategoria:0,
                message : '',
                errorMostrarMsjCategoria:[],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
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
           listarCategoria(page,buscar,criterio){
                let me=this;
                    var url='/categoria?page=' + page + '&buscar=' + buscar;
                    axios.get(url).then(function (response) {
                    me.arrayCategoria=response.data.data;
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
                me.listarCategoria(page,buscar,criterio);
            },
           guardarCategoria(){
               if(this.validarCategoria()){
                   return; 
               }
            let me = this;
                axios.post('/categoria/guardar',{
                    'nombre':this.nombre
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCategoria(1,'');           
                })
                .catch(function(error){
                    console.log(error);
                });   
           },
           actualizarCategoria(){
                if(this.validarCategoria()){
                   return; 
                }
                let me = this;
                axios.put('/categoria/modificar',{
                    'id':this.categoriaId,
                    'nombre':this.nombre
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCategoria(1,'');           
                })
                .catch(function(error){
                    console.log(error);
                });
           },
           desactivarCategoria(id){
               swal({
                title: 'Esta seguro de desactivar esta Categoria?',
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
                    axios.put('/categoria/desactivar',{'id': id}).then(function (response) {
                        me.listarCategoria(1,'');
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
            activarCategoria(id){
               swal({
                title: 'Esta seguro de activar esta Categoria?',
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
                    axios.put('/categoria/activar',{'id': id}).then(function (response) {
                        me.listarCategoria(1,'');
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

           validarCategoria(){
               this.errorCategoria=0;
               this.errorMostrarMsjCategoria=[];

               if(!this.nombre)this.errorMostrarMsjCategoria.push('El nombre de la Categoria esta vacia!');
               if(this.errorMostrarMsjCategoria.length)this.errorCategoria=1;

               return this.errorCategoria;
           },

           cerrarModal(){
                this.modal=0;
                this.tituloModal='';
                this.nombre='';
           },
           abrirModal(model,accion,data=[]){
               switch (model) {
                   case 'categoria':
                       {
                           switch(accion){
                               case 'registrar':
                                   {
                                        this.modal=1;
                                        this.tituloModal='Registrar Categoria';
                                        this.nombre='';
                                        this.tipoAccion=1;
                                         break;
                                   }
                                case 'modificar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Actualizar Categoria';
                                        this.tipoAccion=2;
                                        this.categoriaId=data['id'];
                                        this.nombre=data['nombre'];
                                    }   
                           }
                       }
               }
           },
       },
        mounted() {
            this.listarCategoria(1,this.buscar);
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
