<template>
    <main class="main">
        <!-- Header -->
	<header class="header full-box">
	    <div class="header-brand text-center full-box">
	        <a href="#">
	            <img src="img/logo.jpeg" alt="logo" class="img-fluid">
	        </a>
	    </div>
	    <div class="header-options full-box">
	        <nav class="header-navbar full-box poppins-regular font-weight-bold" >
	            <ul class="list-unstyled full-box">
	                <li>
	                    <a href="#" >Inicio<span class="full-box" ></span></a>
	                </li>
	            </ul>
	        </nav>
	        <div class="header-button full-box text-center btn-login-menu" >
	            <i class="fas fa-user-alt" onclick="show_popup_login()" data-mdb-toggle="tooltip" data-mdb-placement="bottom" title="Login" ></i>
	            <div class="div-bordered popup-login">

	                <!-- Inicio de sesion -->
                    <template v-if="tipoAccion==0">
                        <span class="text-center poppins-regular font-weight-bold">Inicio de Session</span>
                        <form class="full-box" action="">                        
                            <div class="form-outline mb-4">
                                <input type="text" class="form-control" v-model="usuario" placeholder="Usuario">
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" class="form-control" v-model="contra" placeholder="Contraseña">
                            </div>
                            <p class="text-center">
                                <button class="btn btn-info btn-sm w-100" v-if="tipoAccion==0" @click="iniciarSeccion()">Iniciar Sesión</button>
                            </p>
                        </form>
                    </template>
                    <!-- Cerrar Session-->
                    <template v-if="tipoAccion==1">
                        <span class="text-center poppins-regular font-weight-bold">Cerrar Seccion</span>
                        <form class="full-box" action="">
                            <p class="text-center">
                                <button class="btn btn-info btn-sm w-100" @click="cerrarSession()">Cerrar Sesión</button>
                            </p>

                        </form>
                    </template>

	                <!-- Cerrar sesion --
	                <div class="text-center full-box">
	                    <i class="fas fa-user-circle fa-4x"></i>
	                </div>
	                <span class="poppins-regular font-weight-bold">Nombre de usuario</span>
	                <div class="text-center full-box">
	                    <a href="#" class="btn btn-info btn-sm w-100"><i class="fas fa-user-cog fa-fw"></i> &nbsp; Mi cuenta</a>
	                </div>
	                <div class="text-center full-box">
	                    <a href="#" class="btn btn-info btn-sm w-100"><i class="fab fa-dashcube fa-fw"></i> &nbsp; Dashboard</a>
	                </div>
	                <form class="full-box" action="">
	                    <button class="btn btn-raised btn-primary btn-sm w-100" ><i class="fas fa-door-open fa-fw"></i> &nbsp; Cerrar sesión</button>
	                </form>-->
	                
	            </div>
	        </div>
	    </div>
	</header>
    <template v-if="sw==0">
        <!-- Content -->
        <div class="banner">
            <div class="banner-body">
                <h1 class="text-uppercase">Bienvenido</h1>
            </div>
        </div>
        <div class="container container-web-page">
            <h3 class="text-center text-uppercase poppins-regular font-weight-bold">Inmobiliaria MultiLider</h3>
            <br>
            <div class="row">
                <div class="col-12 col-sm-6 col-md-4">
                    <p class="text-center"><i class="fas fa-eye fa-5x"></i></p>
                    <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestra Visión</h5>
                    <p class="text-center">La forma más fácil de vender bienes inmuebles, gestionamos venta de casas, terrenos, propiedades, quintas,
                         avaluos, asesoramiento gratuito.La forma más fácil de vender bienes inmuebles, gestionamos venta de casas, terrenos, propiedades, 
                        quintas, avaluos, asesoramiento gratuito.
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <p class="text-center"><i class="fas fa-rocket fa-5x"></i></p>
                    <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestra Misión</h5>
                    <p class="text-center">La forma más fácil de vender bienes inmuebles, gestionamos su compra ó venta de casas, terrenos, propiedades, 
                        quintas, anticréticos, alquileres, avaluos, asesoramiento gratuito.La forma más fácil de vender bienes inmuebles, gestionamos  
                        venta de casas, terrenos, propiedades, quintas, avaluos, asesoramiento gratuito.
                    </p>
                </div>
                <div class="col-12 col-sm-6 col-md-4">
                    <p class="text-center"><i class="fas fa-store-alt fa-5x"></i></p>
                    <h5 class="text-center text-uppercase poppins-regular font-weight-bold">Nuestro Servicios</h5>
                    <p class="text-center">La forma más fácil de vender bienes inmuebles, gestionamos venta de casas, terrenos, 
                        propiedades, quintas, avaluos, asesoramiento gratuito.
                    </p>
                </div>
            </div>
        </div>

        <hr>
        <!-- Footer -->
        <footer class="footer">
            <div class="container">
                <div class="row">
                    
                    <div class="col-12 col-md-4">
                        <ul class="list-unstyled" >
                            <li><h5 class="font-weight-bold" ><i class="far fa-copyright"></i>Valdivia</h5></li>
                            <li> Todos los derechos reservados </li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-md-4">
                        <ul class="list-unstyled" >
                            <li><h5 class="font-weight-bold" >Inmobiliaria MultiLider</h5></li>
                            <li><i class="fas fa-map-marker-alt fa-fw"></i> Edificio Vásquez, Calle Arenales # 162, Montero, Santa Cruz – Bolivia</li>
                        </ul>
                    </div>

                    <div class="col-12 col-md-4">
                        <ul class="list-unstyled" >
                            <li><h5 class="font-weight-bold" >Siguenos en:</h5> </li>
                            <li>
                                <a href="#" class="footer-link" target="_blank" >
                                    <i class="fab fa-facebook fa-fw"></i> Facebook
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </template>

    <template v-if="sw==1">
        <div class="bordered" style="padding: 15px;">
            <center><h1>Cuota</h1></center>
                <div class="form-group row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <select class="form-control col-md-3">
                                <option value="codigo">Codigo</option>
                            </select>
                            <input type="text" v-model="buscar" @keyup.enter="listarCuota(buscar)" class="form-control" placeholder="Texto a buscar">
                            <button type="submit" @click="listarCuota(buscar)" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cuota in arrayCuota" :key="cuota.id">
                            <td v-text="cuota.fechaCuota"></td>
                            <td v-text="cuota.montoCuota"></td>
                            <td>
                                <template v-if="cuota.estado==0">
                                        <span style="color: white; background: red">Pendiente</span>
                                </template>
                                <template v-if="cuota.estado==1">
                                        <span style="color: white; background: blue">Pagado</span>
                                </template>
                            </td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </template>

    </main>
</template>
<script>
    // import Swal from 'sweetalert2';
    export default {
        data(){
            return {             
                //arrayDepartamento : [],
                //slideImagen:[],
                usuario:'',
                contra:'',
                sw:0,
                tipoAccion:0,
                buscar:'',
                ci:'',
                arrayCuota:[],
            }
        },
        methods : {
            listarCuota(buscar){
                let me=this;
                var url='/cuota/listar?buscar='+ buscar+'&ci='+this.ci;
                axios.get(url).then(function(response){
                    me.arrayCuota=response.data;
                });
            },
            iniciarSeccion(){
                let me=this;
                var resultado;

                var url='/logincliente?usuarioCliente='+ this.usuario + '&contraseña=' + this.contra;
                axios.get(url).then(function(response){
                    resultado=response.data;
                
                if(resultado==0){
                    alert('Error!.. Datos incorrectos');
                }else{
                    me.sw=1;
                    me.tipoAccion=1;   
                    alert('Bienvenido cliente'+' '+response.data.nombre+' '+response.data.apellidos);   
                    me.ci=response.data.ci;            
                }
                });
            },
            cerrarSession(){
                let me=this;
                me.sw=0;
                me.tipoAccion=0;
                me.ci='';
                me.arrayCuota=[];
                me.resultado='';
                me.usuario='';
                me.contra='';
                me.buscar='';
            },
        },
        mounted() {
        }
    }
</script>
<style>
    .hover-galeria{
        position: absolute;
        width: 100%;
        height: 100%;
        top: 0;
        background: hsla(273, 91%, 27%, 0.7);
        transition: transform .5s;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .hover-galeria img{
        width: 50px;
    }
    .hover-galeria p{
        color: #fff;
    }
    .imagen-port:hover .hover-galeria{
        transform:scale(0);
    }
    .imagen-port{
        width: 100%;
        margin-bottom: 10px;
        overflow: hidden;
        position: relative;
        cursor: pointer;
        box-shadow: 0 0 6px 0 rgba(0, 0, 0, .5);
    }
    .imagen-port > img{
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
</style>