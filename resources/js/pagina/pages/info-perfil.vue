<template>
  <main class="main">
    <!--=====================================
    BANNER-INTERIOR
    ======================================-->
    <div class="bannerInterior container-fluid bg-white p-0 d-none d-lg-block">        
        <figure>            
            <img src="img/pagina/banner01.jpg" class="img-fluid" width="100%">
        </figure>
    </div>

    <!--=====================================
    INFO PERFIL
    ======================================-->
    <div class="infoPerfil container-fluid bg-white p-0 pb-5 mb-5">    
      <div class="container">      
        <div class="row">
          <!--=====================================
          BLOQUE IZQ
          ======================================-->        
          <div class="col-12 col-lg-4 colIzqPerfil p-0 px-lg-3">          
            <div class="cabeceraPerfil pt-4">            
              <a href="#" class="float-left lead text-white pt-1 px-3 mb-4">
                <router-link :to="{name: 'Inicio'}"><h5><i class="fas fa-chevron-left"></i> Salir</h5></router-link>
              </a>
              <div class="clearfix"></div>
              <h1 class="text-white p-2 pb-lg-5 text-center text-lg-left">MI PERFIL</h1>	
            </div>

            <!--=====================================
            PERFIL
            ======================================-->
            <div class="descripcionPerfil">            
              <figure class="text-center imgPerfil">                
                <img src="img/pagina/users.png" class="img-fluid">
              </figure>
              <center>
                <p style="text-transform: uppercase;">{{datosUser.nombre+' '+datosUser.paterno+' '+datosUser.materno}}</p>
              </center>              
              <div id="accordion">
                <div class="card">                  
                  <div class="card-header">
                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                      MIS RESERVAS
                    </a>
                  </div>

                  <div id="collapseOne" class="collapse show" data-parent="#accordion">
                    <ul class="card-body">
                      <a href="#" @click="nuevaReserva()">Nueva Reserva</a><br>
                      <a href="#" @click="reservaActual()">Reserva Actual</a><br>
                      <a href="#" @click="reservaAnteriores()">Reservas Anteriores</a><br>
                    </ul>
                  </div>
                </div>

                <div class="card">
                  <div class="card-header">
                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                      MIS DATOS
                    </a>
                  </div>

                  <div id="collapseTwo" class="collapse" data-parent="#accordion">
                    <div class="card-body p-0">
                      <ul class="list-group">                      
                        <li class="list-group-item small">Nombre: {{datosUser.nombre}}</li>
                        <li class="list-group-item small">Apellidos: {{datosUser.paterno+' '+datosUser.materno}}</li>
                        <li class="list-group-item small">Usuario: {{datosUser.login}}</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--=====================================
          BLOQUE DER
          ======================================-->
          <div class="col-12 col-lg-8 colDerPerfil">
            <div class="row">
              <div class="col-6 d-none d-lg-block">              
                <h4 class="float-left">Hola {{datosUser.nombre+' '+datosUser.paterno+' '+datosUser.materno}}</h4>
              </div>
              <div class="col-6 d-none d-lg-block"></div>

              <div class="col-12 mt-3">   

                <template v-if="listado==0">
                  <a href="#modalReserva" data-toggle="modal">seleccionar Habitacion</a>
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>Quitar</th>
                        <th>Habitacion</th>
                        <th>Tipo Habitacion</th>
                        <th>Ubicación</th>
                        <th>Precio</th>
                      </tr>
                    </thead>
                    <tbody v-if="arrayDetalle.length">
                      <tr r v-for="(detalle,index) in arrayDetalle" :key="detalle.id">
                        <td>
                            <button @click="eliminarDetalle(index)" type="button" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                        <td v-text="detalle.habitacion"></td>
                        <td v-text="detalle.tipoHabitacion"></td>
                        <td v-text="detalle.ubicacion"></td>
                        <td v-text="detalle.precio"></td>
                      </tr>
                    </tbody>
                    <tbody v-else>
                      <tr>
                          <td colspan="5">
                              No hay habitacion seleccionado
                          </td>
                      </tr>
                    </tbody>                    
                  </table>
                  <button class="btn btn-info" type="button" @click="guardarReserva()">Guardar Reserva</button>
                  <div v-if="alert==2" class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Registrado!</strong> Se ha registrado exitosamente su reserva.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </template>

                <template v-if="listado==1">
                  <font size="5" face="Times New Roman">Reservas Vigentes</font>
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Cod</th>
                          <th>Fecha</th>
                          <th>Hora</th>
                          <th>Estado</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="reserva in arrayReserva2" :key="reserva.id">
                          <td v-text="reserva.id"></td>
                          <td v-text="reserva.fecha"></td>
                          <td v-text="reserva.hora"></td>
                          <td v-text="reserva.estado"></td>
                          <td>                    
                            <button type="button" class="btn btn-success text-white" @click="verReservaActual(reserva.id, reserva.fecha)"><i class="fas fa-eye"></i></button>
                            <button type="button" class="btn btn-danger text-white" @click="anularReserva(reserva.id)"><i class="fas fa-trash"></i></button>                 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                    <div v-if="alert==1" class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Anulado!</strong> Se ha anulado exitosamente su reserva.
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                </template>

                <template v-if="listado==2">
                     <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Cod</th>
                          <th>Fecha de Ingreso</th>
                          <th>Fecha de Salida</th>
                          <th>Estado</th>
                          <th>Opción</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="reserva in arrayReserva" :key="reserva.id">
                          <td v-text="reserva.id"></td>
                          <td v-text="reserva.fechaEntrada"></td>
                          <td v-text="reserva.fechaSalida"></td>
                          <td v-text="reserva.estado"></td>
                          <td>                    
                            <button type="button" class="btn btn-success text-white" @click="verDetalleReserva(reserva.id, reserva.fechaEntrada)"><i class="fas fa-eye"></i></button>                 
                          </td>
                        </tr>
                      </tbody>
                    </table>
                </template>

                <template v-if="listado==3">
                  <font size="5" face="Times New Roman">Detalle Reserva: {{fechaHospedaje}}</font>
                  <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Habitacion</th>
                          <th>Tipo Habitacion</th>
                          <th>Ubicación</th>
                          <th>Precio</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="detalle in arrayDetalle" :key="detalle.id">
                          <td v-text="detalle.habitacion"></td>
                          <td v-text="detalle.tipoHabitacion"></td>
                          <td v-text="detalle.ubicacion"></td>
                          <td v-text="detalle.precio"></td>
                        </tr>
                      </tbody>
                    </table>
                    <button class="btn btn-secomdary" v-if="tipoAccion==1" type="button" @click="cerrarDetalleReserva()"><i class="fa fa-times"></i> cerrarDetalle</button>
                    <button class="btn btn-secomdary" v-if="tipoAccion==2" type="button" @click="cerrarReservaActual()"><i class="fa fa-times"></i> cerrarDetalle</button>
                </template>

              </div>
            </div>        
          </div>
        </div>
      </div>
    </div>

    <!--Inicio del modal Habitacion-->
    <div class="modal" id="modalReserva">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header bg-info text-white">
						<h4 class="modal-title">Seleccione Habitaciones</h4>
						<button type="button" class="close text-white" data-dismiss="modal">&times;</button>
					</div>
					
					<div class="modal-body">
						<hr class="mt-0">

            <div class="form-group">
                <div class="input-group">
                <select class="form-control" v-model="criterio">                        
                    <option value="">Seleccione</option>
                    <option value="habitacion.nombre">Nombre</option>
                    <option value="habitacion.precio">Precio</option>
                    <option value="habitacion.ubicacion">Ubicacion</option>
                </select>
                <input type="text" v-model="buscar" class="form-control" placeholder="Texto a buscar">
                <button type="submit" @click="listarHabitacion(buscar, criterio)" class="btn btn-info"><i class="fa fa-search"></i> Buscar</button>
                </div>
            </div>
            <label class="text-error" for="#">{{mensajeLogout}}</label>
            <div style="overflow-y: auto; height: 250px;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Foto</th>                                
                    <th>Ubicacion</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Opción</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="habitacion in arrayHabitacion" :key="habitacion.id">
                      <td v-text="habitacion.nombre"></td>
                      <td v-text="habitacion.precio"></td>
                      <td><img :src="'img/habitacion/'+habitacion.foto" width="30" height="30" align="left" alt=""></td>                               
                      <td v-text="habitacion.ubicacion"></td>
                      <td v-text="habitacion.tipo"></td>
                      <td>
                          <div v-if="habitacion.estado">
                              <span class="badge badge-success">Disponible</span>
                          </div>
                          <div v-else>
                              <span class="badge badge-danger">Ocupado</span>
                          </div>                                          
                      </td>
                      <td>
                          <button type="button" @click="seleccionarHospedaje(habitacion)" class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i>
                        </button>                                                                     
                      </td>   
                  </tr>
                </tbody>
              </table>
            </div>
					</div>

				</div>
			</div>
		</div>
    <!--Fin del modal habitacion-->

  </main>
</template>
<script>
  import moment from 'moment';
  export default {
    data(){
      return {
        datosUser : {
          id : this.$route.params.id,
          nombre : '',
          paterno: '',
          materno : '',
          login : '',
          password : ''
        }, 
        datosReserva :{
          datos:{
            id : 0,
            fecha : '',
            hora : '',
            idRegistrate : 0
          },
          detalle:[]
        },
        fechaHospedaje: '',
        loginSession: '',
        passwordSession : '',
        tipoAccion :0,
        alert : 0,
        arrayReserva : [],
        arrayReserva2 : [],
        arrayDetalle : [],
        arrayHabitacion : [], 
        mensajeLogout : '',
        listado : 0,
        errorReserva : 0, 
        errorMostrarMsjReserva : [],
        buscar : '',
        criterio : 'habitacion.nombre',
      }
    },
    methods : {
      cargarSesion(){
        let me = this;
        var arrayRegistrateT = [];
        var url = '/registrate/autentificado?idRegistrate='+me.datosUser.id;
        axios.get(url).then(function (response) { 
          arrayRegistrateT=response.data;

          me.datosUser.id=arrayRegistrateT[0]['id'];
          me.datosUser.nombre=arrayRegistrateT[0]['nombre'];
          me.datosUser.paterno=arrayRegistrateT[0]['paterno'];
          me.datosUser.materno=arrayRegistrateT[0]['materno'];
          me.datosUser.login=arrayRegistrateT[0]['login'];
          me.datosUser.password=arrayRegistrateT[0]['password'];
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      reservaAnteriores(){
        let me = this;
        me.listado=2;
        var url = '/reserva/reservaAnterior?idRegistrate='+me.datosUser.id;
        axios.get(url).then(function (response) { 
          me.arrayReserva=response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      reservaActual(){
        let me = this;
        me.listado=1;
        var url = '/reserva/reservaActual?idRegistrate='+me.datosUser.id;
        axios.get(url).then(function (response) { 
          me.arrayReserva2=response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      verDetalleReserva(id,fechaEntrada){
        let me = this;
        me.listado=3;
        me.tipoAccion=1;
        me.fechaHospedaje=fechaEntrada;
        var url = '/reserva/verDetalle?idReserva='+id;
        axios.get(url).then(function (response) { 
          me.arrayDetalle=response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      verReservaActual(id,fecha){
        let me = this;
        me.listado=3;
        me.tipoAccion=2;
        me.fechaHospedaje=fecha;
        var url = '/reserva/verDetalle?idReserva='+id;
        axios.get(url).then(function (response) { 
          me.arrayDetalle=response.data;
        })
        .catch(function (error) {
            console.log(error);
        });
      },
      cerrarDetalleReserva(){
        let me = this;
        me.arrayDetalle=[];
        me.fechaHospedaje='';
        me.tipoAccion=0;
        me.listado=2;        
      },
      cerrarReservaActual(){
        let me = this;
        me.arrayDetalle=[];
        me.fechaHospedaje='';
        me.tipoAccion=0;
        me.listado=1;
      },
      anularReserva(id){
        let me=this;       

        axios.put('/reserva/anular/'+id).then(function(response){
            me.alert=1;         
            me.reservaActual();
        }).catch(function(error){
            console.log(error);
        });
      },
      listarHabitacion(buscar, criterio){
          let me = this;
          var url='/habitacion/habitacionReserva?buscar=' + buscar + '&criterio=' + criterio;
          axios.get(url).then(function(response){
              me.arrayHabitacion= response.data;
          })
          .catch(function(error){
              console.log(error);
          });
      },
      encuentra(id){
          var sw=0;
          for(var i=0;i<this.arrayDetalle.length;i++){
              if(this.arrayDetalle[i].idHabitacion==id){
                  sw=true;
              }
          }
          return sw;
      },
      eliminarDetalle(index){
          let me = this;
          me.arrayDetalle.splice(index,1);
      },
      seleccionarHospedaje(data=[]){
        let me = this;
        if(me.encuentra(data['id'])){
          me.mensajeLogout='ya se encuentra agrado..!';
        }
        else{
          if(data['estado']==0){
            me.mensajeLogout='esta habitacion no esta diponible..!';
          }
          else{
            me.mensajeLogout='';
            me.arrayDetalle.push({
                idHabitacion : data['id'],
                habitacion : data['nombre'],
                tipoHabitacion : data['tipo'],
                ubicacion : data['ubicacion'],
                precio : data['precio'],
            });
          }
          
        }
      },
      nuevaReserva(){
        let me = this;
        me.listado=0;
        me.alert=0;
        me.arrayDetalle=[];
        me.datosReserva.detalle=[];
        me.datosReserva.datos = {
          id : 0,
          fecha : '',
          hora : '',
          idRegistrate : 0
        }
      },
      guardarReserva(){
        let me = this;
        me.datosReserva.datos.fecha=moment().format('YYYY-MM-DD');
        me.datosReserva.datos.hora=moment().format('HH:mm:ss');
        me.datosReserva.datos.idRegistrate=me.datosUser.id;
        me.datosReserva.detalle= me.arrayDetalle;
        axios.post('/reserva/guardar',me.datosReserva).then(function (response) {
            me.alert=2;     
        }).catch(function (error) {
            console.log(error);
        });
      }
    },
    mounted() {
      this.cargarSesion();
    }
}
</script>
<style>
  .div-error{
      display: flex;
      justify-content: center;
  }
  .text-error{
      color: rgb(0, 110, 255) !important;
      font-weight: bold;
  }
</style>