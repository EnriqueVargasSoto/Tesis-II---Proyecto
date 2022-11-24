<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Documento de Venta</title>
</head>
<style>
    html {
        /* margin: 0px !important; */
        margin: 25px;
    }

    body {
        font-size: 6pt;
        padding: 0px;
        margin: 0px;
        font-family: Arial, Helvetica, sans-serif;
        color: black;
    }

    /* .small {
        font-size: 80%;
    } */
    .font-weight-bold {
        font-weight: 700 !important;
    }

    .font-weight-none {
        font-weight: none !important
    }

    .cuadro-documento {
        border: solid;
        width: 100px;
        height: 40px;
        margin: 0 auto;

    }

    .padre {
        width: 100%;

    }

    .text-uppercase {
        text-transform: uppercase !important;
    }

    .table-light,
    .table-light>th,
    .table-light>td {
        background-color: #fdfdfe;
    }

    .table th,
    .table td {
        vertical-align: top;
    }

    .table thead th {
        vertical-align: bottom;
    }

    .table .thead-light th {
        color: #495057;
        background-color: #e9ecef;
    }

    .qr {
        position: relative;
        width: 100%;
        align-content: center;
        text-align: center;
        margin-top: 10px;
    }

</style>

<body>
    <table style="width:100%;">
        <thead>
            <tr>
                <th style="width:60%">

                    @if ($empresa)
                        <img src="{{ base_path() . '/storage/app/' . $empresa->url_imagen }}"
                            style="height: 100px;width:100%">
                    @else
                        <img src="{{ public_path() . '/default.png' }}" style="height: 100px;width:100%">
                    @endif

                </th>
            </tr>
            <tr>
                <th>

                    <div class="text-uppercase text-center">
                        {{ $empresa == false ? '-' : $empresa->nombre_comercial }}</div>

                </th>
            </tr>
            <tr>
                <th style="width:100%;">

                    <div class=" font-weight-bold">
                        Direccion
                        <span class="font-weight-none">{{ $empresa == false ? '-' : $empresa->telefono }}<span>
                    </div>


                    <div class=" font-weight-bold">
                        Telefono:
                        <span class="font-weight-none">{{ $empresa == false ? '-' : $empresa->telefono }}</span>
                    </div>


                    <div class=" font-weight-bold">
                        Email:
                        <span class="font-weight-none">{{ $empresa == false ? '-' : $empresa->correo }}</span>
                    </div>

                </th>
            </tr>
            <tr>
                <th>
                    <div class="padre">
                        <div class="cuadro-documento text-center" style="border-color:#18a689">
                            <div class="font-weight-light">
                                RUC {{ $empresa == false ? '-' : $empresa->ruc }}
                            </div>
                            <div style="background-color:#18a689;
                        color:black">
                                {{ $documento->tipo_documento_id == null ? 'Ticket-' . $pedido->id : $documento->correlativo->numeracion->serie . '-' . $documento->correlativo->correlativo }}
                            </div>
                            {{-- <div class="font-weight-light">
                                {{ $pedido->tipoDocumento->tipo }}
                            </div> --}}
                        </div>
                    </div>

                </th>
            </tr>
        </thead>
    </table>
    <table style="width:100%;" class="mt-5">
        <thead>
            <tr>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <div class="font-weight-bold text-uppercase ">
                        Nombre:

                    </div>
                </td>
                <td>
                    <span class="font-weight-none">{{ $documento->cliente->nombre }}</span>
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <div class=" font-weight-bold m-0 text-uppercase ">
                        N°Documento:
                    </div>
                </td>
                <td>
                    <span class="font-weight-none">{{ $documento->cliente->documento }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class=" font-weight-bold text-uppercase ">
                        Fecha Emision:
                    </div>
                </td>
                <td>
                    <span class="font-weight-none">{{ $pedido->created_at->format('Y-m-d h:i') }}</span>
                </td>
            </tr>
            <tr>
                <td style="width:50%;">
                    <div class=" font-weight-bold text-uppercase ">
                        Direccion:
                    </div>
                </td>
                <td>
                    <span class="font-weight-none ">{{ $documento->cliente->direccion }}</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class=" font-weight-bold text-uppercase ">
                        Tipo de Moneda:
                    </div>
                </td>
                <td>
                    <span class="font-weight-none">SOLES</span>
                </td>
            </tr>
            <tr>
                <td>
                    <div class=" font-weight-bold text-uppercase ">
                        Forma de Pago:
                    </div>
                </td>
                <td>
                    <span
                        class="font-weight-none text-uppercase">{{ ($pedido->pago->pagoEfectivo ? 'Efectivo' : '') . ($pedido->pago->pagoTarjeta()->count() != 0 ? 'TARJETA' : '') }}</span>
                </td>
            </tr>
        </tbody>
    </table>
    <div>
        <table style="width:100%" cellspacing="0" class="table table-light mt-3 ">
            <thead>
                <tr>
                    <th style="text-align:center">
                        Cant</th>
                    <th style="text-align:center">
                        Descripcion</th>
                    <th style="text-align:center">
                        P.Unitario</th>
                    <th style="text-align:right">
                        Sub total</th>
                </tr>
            </thead>
            <tbody class="">
                @foreach ($pedido->detalle as $item)
                    @if ($item->estado_pedido != 'PENDIENTE')
                        <tr>
                            <th class="text-center">{{ $item->cantidad }}</th>
                            <th>{{ $item->producto->nombre }}</th>
                            <th>{{ $item->producto->precio }}</th>
                            <th style="text-align:right">
                                {{ number_format($item->producto->precio * $item->cantidad, 2, '.', ' ') }}</th>
                        </tr>
                    @endif

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th style="text-align:right" colspan="3">Sub Total: S/.</th>
                    <th style="text-align:right">{{ number_format($documento->total / (1 + 0.18), 2) }}</th>
                </tr>
                <tr>
                    <th style="text-align:right" colspan="3">IGV : S/.</th>
                    <th style="text-align:right">
                        {{ number_format($documento->total - $documento->total / (1 + 0.18), 2) }}
                    </th>
                </tr>
                <tr>
                    <th style="text-align:right" colspan="3">Total a pagar: S/.</th>
                    <th style="text-align:right">{{ number_format($documento->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="qr">
        @if ($documento->url_qr)
            <img src="{{ base_path() . '/storage/app/' . $documento->url_qr }}">
        @endif
        @if ($documento->hash)
            <p class="m-0 p-0">Código Hash: {{ $documento->hash }}</p>
        @endif
    </div>
    <br>
    <br>

</body>

</html>
