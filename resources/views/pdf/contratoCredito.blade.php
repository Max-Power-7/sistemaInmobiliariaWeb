<!DOCTYPE>
<html>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de NotaVenta</title>
    <style>
        body {
        /*position: relative;*/
        /*width: 16cm;  */
        /*height: 29.7cm; */
        /*margin: 0 auto; */
        /*color: #555555;*/
        /*background: #FFFFFF; */
        font-family: Arial, sans-serif; 
        font-size: 14px;
        /*font-family: SourceSansPro;*/
        }

        #logo{
        float: left;
        margin-top: 1%;
        margin-left: 2%;
        margin-right: 2%;
        }

        #imagen{
        width: 130px;
        }

        #datos{
        float: left;
        margin-top: 0%;
        margin-left: 2%;
        margin-right: 2%;
        /*text-align: justify;*/
        }

        #encabezado{
        text-align: center;
        margin-left: 10%;
        margin-right: 35%;
        font-size: 15px;
        }

        #fact{
        /*position: relative;*/
        float: right;
        margin-top: 2%;
        margin-left: 2%;
        margin-right: 2%;
        font-size: 20px;
        }

        section{
        clear: left;
        }

        #cliente{
        text-align: left;
        }

        #facliente{
        width: 40%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #fac, #fv, #fa{
        color: #FFFFFF;
        font-size: 15px;
        }

        #facliente thead{
        padding: 20px;
        background: #a6d4f2;
        text-align: left;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facvendedor{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facvendedor thead{
        padding: 20px;
        background: #a6d4f2;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #facarticulo{
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-bottom: 15px;
        }

        #facarticulo thead{
        padding: 20px;
        background: #a6d4f2;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;  
        }

        #gracias{
        text-align: center; 
        }
    </style>
    <body>
    @foreach ($notacompra as $c)
        <?php $datoPro='';
                $total=0.00;
        ?>
        @if($c->nombre==null && $c->razonSocial!=null)
           <?php $datoPro=$c->razonSocial;?>
        @endif

        @if($c->razonSocial==null && $c->nombre!=null)
           <?php $datoPro=$c->nombre .' '.$c->apellidos;?>
        @endif
        
        <header>
            <div id="logo">
                <img src="img/farmaciaLogo.png" alt="incanatoIT" id="imagen"><br>
                <b>Farmacia Sebastian</b><br>Montero, Santa Cruz-Bolivia<br>Telefono: 75388927<br>Email:Farmacia_sebastian@hotmail.com <br>
            </div>
            <div id="datos">
                <p id="encabezado">
                    <h1>Boleta Compra</h1>
                </p>
            </div>
            <div id="fact">
                <p>NroDoc<br>1<br></p>
            </div>
        </header>
        <br>
        <section>
            <div>
                <table id="facliente">
                    <thead>                        
                        <tr>
                            <th id="fac">Proveedor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th><p id="cliente">Señor(es): <?php echo $datoPro; echo "  ";?><br>
                            Dirección: {{$c->direccion}}<br>
                            Correo: {{$c->mail}}<br>
                            Teléfono: {{$c->telefono}}</p></th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    @endforeach
        <br>
        <section>
            <div>
                <table id="facvendedor">
                    <thead>
                        <tr id="fv">
                            <th>Usuario</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$c->usuario}}</td>
                            <td>{{$c->fecha}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        <br>
        <section>
            <div>
                <table id="facarticulo">
                    <thead>
                        <tr id="fa">

                            <th>Codigo</th>
                            <th>Medicamento</th>
                            <th>Cantidad</th>
                            <th>PRECIO UNIT</th>
                            <th>PRECIO TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detallecompra as $det)
                        <tr>
                            <td>{{$det->codMedicamento}}</td>
                            <td>{{$det->nombreMedicamento}}</td>
                            <td>{{$det->cantidad}}</td>
                            <td>{{$det->precioc}}</td>
                            <td><?php $total=$total+$det->cantidad*$det->precioc;?> {{$det->cantidad*$det->precioc}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @foreach ($notacompra as $c)
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Sub Total</th>
                            <td>Bs <?php echo $total;?></td>
                        </tr>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>TOTAL</th>
                            <td>Bs {{$c->montoTotal}}</td>
                        </tr>
                        @endforeach
                    </tfoot>
                </table>
            </div>
        </section>
        <br>
        <br>
        <footer>
            <div id="gracias">
                <p><b>Gracias!</b></p>
            </div>
        </footer>
    </body>
</html>
