<template>
    <main class="main">
            <!-- Breadcrumb -->
            <div class="container-fluid">
                <!-- Ejemplo de tabla Listado -->
                <div class="card">
                    <div class="card-header">
                         Pago
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <select class="form-control col-md-3" v-model="criterio">
                                      <option value="propiedad.codigo">Codigo de Propiedad</option>
                                    </select>

                                    <input type="text" v-model="buscar" @keyup.enter="listar(1,buscar,criterio)" class="form-control" placeholder="Texto a buscar">
                                    <button type="submit" @click="listar(1,buscar,criterio)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Codigo Propiedad</th>
                                    <th>Fecha</th>
                                    <th>Monto</th>
                                    <th>Total a Pagar</th>
                                    <th>Opciones</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="cuota in arrayCuota" :key="cuota.id">
                                    <td v-text="cuota.codigoPropiedad"></td>
                                    <td v-text="cuota.fechaCuota"></td>
                                    <td v-text="cuota.montoCuota"></td>
                                    <td v-text="cuota.totalPagar"></td>
                                    
                                    <td v-if="cuota.estado==0">
                                        <button type="button" @click="guardarPago(cuota)" class="btn btn-primary btn-sm">
                                            <i class="icon-check"></i>
                                        </button>
                                    </td>

                                    <td v-else>

                                    </td>

                                    <td>
                                        <div v-if="cuota.estado==1">
                                                <span class="badge badge-success">Pagado</span>
                                            </div>
                                            <div v-else>
                                                <span class="badge badge-danger">Pendiente</span>
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
        </main>
</template>

<script>
    import moment from 'moment';
    export default {
        data(){
            return {
                    fecha : moment().format('YYYY-MM-DD'),
                    monto: 0,
                    idCuota:0,
                    arrayCuota:[],
                    modalNuevoPropietario:0,
                errorMostrarMsjCuota: [],
                criterio : 'codigo',
                buscar : '',
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
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
           listar(page,buscar,criterio){
                let me=this;
                    var url='/cuota?page=' + page + '&buscar=' + buscar + '&criterio=' + criterio;
                    axios.get(url).then(function (response) {
                    me.arrayCuota=response.data.data;
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
                me.listar(page,buscar,criterio);
            },
            guardarPago(data=[]){
               swal({
                title: 'Esta seguro de Guardar este Pago?',
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
                    axios.post('/pago/guardar',{
                        'fecha': this.fecha,
                        'monto': data['montoCuota'],
                        'idCuota': data['idCuota']
                    }).then(function(response){
                        me.listar(1,'','propiedad.codigo');
                        swal(
                        'Activado!',
                        'El registro ha sido Guardado con éxito.',
                        'success'
                        )         
                    })
                    .catch(function(error){
                        console.log(error);
                    });
                } else if (
                    // Read more about handling dismissals
                    result.dismiss === swal.DismissReason.cancel
                ) {
                    
                }
                }) 
            },
       },
        mounted() {
            //this.listar(1,this.buscar,this.criterio);
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
