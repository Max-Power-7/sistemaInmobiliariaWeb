<template>
<section class="content">
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{totalVenta}}<sup style="font-size: 20px">Bs</sup></h3>

                <p>Total Venta Inmobiliaria</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">Mas Informacción <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{cantidadAgente}}</h3>

                <p>Cantidad Agentes</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">Mas Informacción <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{cantidadPropiedad}}</h3>

                <p>Cantidad Inmobiliaria Vendidas</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">Mas Informacción <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       
      </div><!-- /.container-fluid -->
    </section>
</template>
<script>
    export default {
        data(){
            return {
                totalVenta: 0,
                cantidadPropiedad:0,
                cantidadAgente:0,
            }
        },
       methods: {           
           getVentaMontoTotal(){
              let me=this;
              var url='/notaventa/montoT';
              axios.get(url).then(function (response){
                    me.totalVenta = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          getCantidadPropiedades(){
              let me=this;
              var url='/propiedad/cantidad';
              axios.get(url).then(function (response){
                    me.cantidadPropiedad = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
          getCantidadAgente(){
              let me=this;
              var url='/agente/cantidad';
              axios.get(url).then(function (response){
                    me.cantidadAgente = response.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
          },
       },
        mounted() {
            this.getVentaMontoTotal();
            this.getCantidadPropiedades();
            this.getCantidadAgente();
        }
    }
</script>
<style>

