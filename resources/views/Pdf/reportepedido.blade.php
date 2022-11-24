<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Pedido</title>
    <link rel="icon" href="{{ base_path() . '/img/siscom.ico' }}" />
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            color: black;
        }

        .cabecera {
            width: 100%;
            position: relative;
            height: 100px;
            max-height: 150px;
        }

        .logo {
            width: 30%;
            position: absolute;
            left: 0%;
        }

        .logo .logo-img {
            position: relative;
            width: 95%;
            margin-right: 5%;
            height: 90px;
        }

        .img-fluid {
            width: 100%;
            height: 100%;
        }

        .empresa {
            width: 60%;
            position: absolute;
            left: 30%;
        }

        .empresa .empresa-info {
            position: relative;
            width: 100%;
        }

        .nombre-empresa {
            font-size: 16px;
        }

        .ruc-empresa {
            font-size: 15px;
        }

        .direccion-empresa {
            font-size: 12px;
        }

        .text-info-empresa {
            font-size: 12px;
        }

        .comprobante {
            width: 30%;
            position: absolute;
            left: 70%;
        }

        .comprobante .comprobante-info {
            position: relative;
            width: 100%;
            display: flex;
            align-content: center;
            align-items: center;
            text-align: center;
        }

        .numero-documento {
            margin: 1px;
            padding-top: 20px;
            padding-bottom: 20px;
            border: 2px solid #52BE80;
            font-size: 14px;
        }

        .nombre-documento {
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 0px;
            margin-right: 0px;
            width: 100%;
            background-color: #7DCEA0;
        }

        .logos-empresas {
            width: 100%;
            height: 105px;
        }

        .img-logo {
            width: 95%;
            height: 100px;
        }

        .logo-empresa {
            width: 14.2%;
            float: left;
        }

        .informacion {
            width: 100%;
            position: relative;
            border: 2px solid #52BE80;
        }

        .tbl-informacion {
            width: 100%;
            font-size: 12px;
        }

        .cuerpo {
            width: 100%;
            position: relative;
            border: 1px solid #52BE80;
            margin-top: 10px;
        }

        .tbl-detalles {
            width: 100%;
            font-size: 12px;
        }

        .tbl-detalles thead {
            border-top: 2px solid #52BE80;
            border-left: 2px solid #52BE80;
            border-right: 2px solid #52BE80;
        }

        .tbl-detalles tbody {
            border-top: 2px solid #52BE80;
            border-bottom: 2px solid #52BE80;
            border-left: 2px solid #52BE80;
            border-right: 2px solid #52BE80;
        }

        .info-total-qr {
            position: relative;
            width: 100%;
        }

        .tbl-total {
            width: 100%;
            border: 2px solid #229954;
        }

        .qr-img {
            margin-top: 15px;
        }

        .text-cuerpo {
            font-size: 12px
        }

        .tbl-qr {
            width: 100%;
        }

        /*---------------------------------------------*/

        .m-0 {
            margin: 0;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .p-0 {
            padding: 0;
        }

    </style>
</head>

<body>
    <div class="cabecera">
        <div class="logo">
            <div class="logo-img">
                @if (DB::table('empresa_personal')->first()->url_imagen!=null)
                    <img src="{{ base_path() . '/storage/app/' . DB::table('empresa_personal')->first()->url_imagen }}"
                        class="img-fluid">
                @endif
            </div>
        </div>
        <div class="empresa">
            <div class="empresa-info">
                <p class="m-0 p-0 text-uppercase nombre-empresa">
                    {{ DB::table('empresa_personal')->count() == 0 ? '-' : DB::table('empresa_personal')->first()->nombre_comercial }}
                </p>
                <p class="m-0 p-0 text-uppercase direccion-empresa">Direccion:
                    {{ DB::table('empresa_personal')->count() == 0 ? '-' : DB::table('empresa_personal')->first()->direccion }}
                </p>

                <p class="m-0 p-0 text-info-empresa">Central telefónica:
                    {{ DB::table('empresa_personal')->count() == 0 ? '-' : DB::table('empresa_personal')->first()->telefono }}
                </p>
                <p class="m-0 p-0 text-info-empresa">Email:
                    {{ DB::table('empresa_personal')->count() == 0 ? '-' : DB::table('empresa_personal')->first()->correo }}
                </p>
            </div>
        </div>

    </div><br>
    <span style="text-transform: uppercase;font-size:15px;color:rgb(38, 8, 212)">Pedido</span>
    <p class="m-0 p-0" style="margin-left: 20px;">Tipo Pedido:{{ $pedido->tipo->tipo_pedido }}
    </p>
    <p class="m-0 p-0" style="margin-left: 20px;">Cliente:
        {{ $pedido->cliente->nombres . ' ' . $pedido->cliente->apellidoPaterno . ' ' . $pedido->cliente->apellidoMaterno }}
    </p>
    <p class="m-0 p-0" style="margin-left: 20px;">Estado Pedido: {{ $pedido->estado_pedido }}
    </p>
    </p>
    <span style="text-transform: uppercase;font-size:15px; color:rgb(38, 8, 212)">Detalles del Pedido</span>
    <br>
    <div class="cuerpo">
        <table class="tbl-detalles text-uppercase" cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th
                        style="text-align: center; border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        Producto</th>
                    <th
                        style="text-align: center; border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        Estado</th>
                    <th
                        style="text-align: center; border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        descripcion</th>
                    <th
                        style="text-align: center; border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        Precio</th>
                    <th
                        style="text-align: center;border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        Cantidad</th>
                    <th
                        style="text-align: center; border-right: 2px solid #52BE80; background-color:#52BE80;color:white;">
                        Total</th>
                </tr>
            </thead>
            <tbody>
                {{ $total = 0 }}
                @foreach ($pedido->detalle as $detalle)
                    <tr>
                        <td style="text-align: center; border-right: 2px solid #52BE80">
                            {{ $detalle->producto->nombre }}
                        </td>
                        <td style="text-align: center; border-right: 2px solid #52BE80">{{ $detalle->estado_pedido }}
                        </td>
                        <td style="text-align: center; border-right: 2px solid #52BE80">{{ $detalle->descripcion }}
                        </td>
                        <td style="text-align: center; border-right: 2px solid #52BE80">
                            {{ $detalle->producto->precio }}</td>
                        <td style="text-align: center; border-right: 2px solid #52BE80">{{ $detalle->cantidad }}</td>
                        <td style="text-align: center; border-right: 2px solid #52BE80">
                            {{ $detalle->producto->precio * $detalle->cantidad }}</td>
                        {{ $total += $detalle->producto->precio * $detalle->cantidad }}
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5"
                        style="text-align: center; border-right: 2px solid #52BE80;background-color:#52BE80;color:white;">
                        TOTAL</td>
                    <td
                        style="text-align: center; border-right: 2px solid #52BE80;background-color:#52BE80;color:white;">
                        {{ $total }}</td>

                </tr>
            </tbody>
        </table>
    </div><br>
</body>

</html>
