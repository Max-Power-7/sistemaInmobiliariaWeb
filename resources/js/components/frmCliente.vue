<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <!-- Agregar nuevo cliente -->
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i> Cliente
                        <button type="button" @click="abrirModal('cliente','registrar')" class="btn btn-secondary">
                            <i class="icon-plus"></i>&nbsp;Nuevo
                        </button>
                    </div>
                    <div class="card-body">
                        <!-- Búsqueda de registros -->
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="nombre">Nombre</option>
                                      <option value="apellidos">Apellidos</option>
                                      <option value="razonSocial">RazonSocial</option>
                                    </select>
                                    <input type="text" v-model="buscar" @keyup.enter="listarCliente(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listarCliente(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>

                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Apellidos</th>
                                    <th>Razon Social</th>
                                    <th>Direccion</th>
                                    <th>Correo Electronico</th>
                                    <th>Telefono</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cliente in arrayCliente" :key="cliente.id">

                                    <td v-text="cliente.nombre"></td>
                                    <td v-text="cliente.apellidos"></td>
                                    <td v-text="cliente.razonSocial"></td>
                                    <td v-text="cliente.direccion"></td>
                                    <td v-text="cliente.correo"></td>
                                    <td v-text="cliente.telefono"></td>
                                    <td>
                                        <div class="dropdown">
                                                <button class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    Accion
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item bg-light" href="#" @click="abrirModal('cliente','modificar',cliente)"><i class="icon-pencil text-warning"></i>Editar
                                                    </a>
                                                    <a class="dropdown-item bg-light" href="#" @click="eliminarCliente(cliente.id)"><i class="icon-trash text-danger"></i>Eliminar</a>
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
                                    <label class="col-md-3 form-control-label" for="text-input">Seleccione Un Tipo</label>
                                    <div class="col-md-9">
                                    <select  class="form-control" v-model="tipo">
                                        <option value="0" disableb="">Seleccione...</option>
                                        <option value="persona">Persona</option>
                                        <option value="empresa">Empresa</option>
                                    </select>
                                    </div>
                                </div>

                                    <template v-if="tipo=='persona'">
                                       <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Nombre</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="nombre" placeholder="Nombre">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Apellidos</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="apellidos" placeholder="Apellidos">
                                            </div>
                                        </div>
                                    </template>

                                    <template v-if="tipo=='empresa'">
                                        <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Razon Social</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="razonSocial" placeholder="Razon social">
                                            </div>
                                        </div>
                                    </template>

                                <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Direccion</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="direccion" placeholder="Direccion">
                                            </div>
                                </div>

                                <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Correo Electronico</label>
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" v-model="correo" placeholder="email@example.com">
                                            </div>
                                </div>
                                <div class="form-group row">
                                          <label class="col-md-3 form-control-label" for="text-input">Telefono</label>
                                            <div class="col-md-9">
                                                <input type="number" class="form-control" v-model="telefono" placeholder="Telefono">
                                            </div>
                                </div>

                                <div v-show="errorCliente" class="form-group row div-error">
                                        <div class="text-center text-error">
                                            <div v-for="error in errorMostrarMsjCliente" :key="error" v-text="error">

                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==1" @click="guardarCliente()">Guardar</button>
                            <button type="button" class="btn btn-primary" v-if="tipoAccion==2" @click="modificarCliente()">Modificar</button>
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
                clienteId:0,
                tipo:'',
                nombre:'',
                apellidos:'',
                razonSocial:'',
                direccion:'',
                correo:'',
                telefono:'',

                arrayCliente:[],
                modal:0,
                tituloModal:'',
                tipoAccion:0,
                errorCliente:0,
                errorMostrarMsjCliente:[],
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
           listarCliente(page,buscar,criterio){
                let me=this;
                    var url='/cliente?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                    axios.get(url).then(function (response) {
                    me.arrayCliente=response.data.data;
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
                me.listarCliente(page,buscar,criterio);
            },
            guardarCliente(){
               if(this.validarCliente()){
                   return;
                }
            let me = this;
                axios.post('/cliente/guardar',{
                    'direccion':this.direccion,
                    'correo':this.correo,
                    'telefono':this.telefono,
                    'tipo':this.tipo,
                    'nombre':this.nombre,
                    'apellidos':this.apellidos,
                    'razonSocial':this.razonSocial
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCliente(1,'','nombre');
                })
                .catch(function(error){
                    console.log(error);
                });
           },
           modificarCliente(){
                if(this.validarCliente()){
                  return;
                }
            let me = this;
                axios.put('/cliente/modificar',{
                    'id':this.clienteId,
                    'direccion':this.direccion,
                    'correo':this.correo,
                    'telefono':this.telefono,
                    'tipo':this.tipo,
                    'nombre':this.nombre,
                    'apellidos':this.apellidos,
                     'razonSocial':this.razonSocial
                }).then(function(response){
                    me.cerrarModal();
                    me.listarCliente(1,'','');
                })
                .catch(function(error){
                    console.log(error);
                });
           },
           eliminarCliente(id){
               swal({
                title: 'Esta seguro de eliminar este Cliente?',
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
                    axios.delete('/cliente/eliminar/'+id).then(function (response) {
                        me.listarCliente(1,'','nombre');
                        swal(
                        'Eliminado!',
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

           validarCliente(){
               this.errorCliente=0;
               this.errorMostrarMsjCliente=[];

               if(this.tipo==0)this.errorMostrarMsjCliente.push('Seleccione un Tipo!');
               if(!this.direccion)this.errorMostrarMsjCliente.push('La Direccion esta vacia!');
               if(this.errorMostrarMsjCliente.length)this.errorCliente=1;

               return this.errorCliente;
           },

           cerrarModal(){
               this.modal=0;
               this.tituloModal='';
               this.nombre='';
               this.apellidos='';
               this.razonSocial='';
               this.direccion='';
               this.telefono='';
               this.tipo='';
               this.correo='';
           },
           abrirModal(model,accion,data=[]){
               switch (model) {
                   case 'cliente':
                       {
                           switch(accion){
                               case 'registrar':
                                   {
                                        this.modal=1;
                                        this.tituloModal='Registrar Cliente';
                                        this.nombre='';
                                        this.apellidos='';
                                        this.razonSocial='',
                                        this.telefono='';
                                        this.direccion='';
                                        this.correo='';
                                        this.tipo='0';
                                        this.tipoAccion=1;
                                        break;
                                   }
                                case 'modificar':
                                    {
                                        this.modal=1;
                                        this.tituloModal='Modificar Cliente';
                                        this.tipoAccion=2;
                                        this.clienteId=data['id'];
                                        this.nombre=data['nombre'];
                                        this.apellidos=data['apellidos'];
                                        this.razonSocial=data['razonSocial'];
                                        this.direccion=data['direccion'];
                                        this.telefono=data['telefono'];
                                        this.correo=data['correo'];
                                        this.tipo=data['tipo'];
                                    }
                           }
                       }
               }
           }
       },
        mounted() {
            this.listarCliente(1,this.buscar,this.criterio);
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
        color:red !important;
        font-weight: bold;
    }
</style>
