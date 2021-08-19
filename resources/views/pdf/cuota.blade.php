<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Cuota</title>
    <style>
        body{
            margin:0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI",Roboto,"Helvetica Neue";
            font-size: 0.875rem;
            font-weight:normal;
            line-height:1.5;
            color:#151b1e;
        }
        .table{
            display:table;
            width:100%;
            max-width:100%;
            margin-bottom:1rem;
            background-color:transparent;
            border-collapse:collapse;
        }
        .table-bordered{
            border:1px solid #c2cfd6;
        }
        th,td{
            display:table-cell;
            vertical-align:inherit;
        }
        th{
            font-weight:bold;
            text-align:-internal-center;
            text-align:left;
        }
        tbody{
            display:table-row-group;
            vertical-align:middle;
            border-color:inherit;
        }
        tr{
            display:table-row;
            vertical-align:inherit;
            border-color:inherit;
        }
        .table-striped tbody tr:nth-of-type(odd){
            background-color:rgba(0,0,0,0.05);
        }
        .izquierda{
            float:left;
        }
        .derecha{
            float:right;
        }
    </style>
</head>
<body>
@foreach($cuota as $cuot)
<?php $nombre=$cuota->nombreCliente;?>
@endforeach
    <div>
        <h3 align="center">Lista de Medicamento del<?php echo ' '.$nombre;?></h3> <h3><span class="derecha">{{now()}}</span></h3><br>
    </div>
    <div>
        <table class="table table-bordered table-sm">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Nombre</th>
                    <th>Descripcion</th>
                    <th>Accion Terapeutica</th>
                    <th>Stock</th>
                    <th>Fecha Vencimiento</th>
                    <th>Laboratorio</th>
                    <th>Almacen</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</body>
</html>