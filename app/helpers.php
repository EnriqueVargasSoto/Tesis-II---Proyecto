<?php

use App\Models\Administracion\Cliente;
use App\Models\Administracion\TipoEmpleado;
use App\Models\EmpresaPersonal;
use App\Models\Mantenimiento\NumeracionConteo;
use App\Models\Ventas\Pedido;

if (!function_exists('current_user')) {
    function current_user()
    {
        return auth()->user();
    }
}
if (!function_exists('tipos_empleado')) {
    function tipos_empleado()
    {
        return TipoEmpleado::where('estado', 'ACTIVO')->get();
    }
}
if (!function_exists('pedidosCobrados')) {
    function pedidosCobrados()
    {
        return Pedido::where('estado_pedido', 'COBRADO')->get();
    }
}
if (!function_exists('getClientes')) {
    function getClientes()
    {
        return Cliente::where('tipo_documento', 'DNI')->where('id', '!=', 1)->get();
    }
}
if (!function_exists('getClientesRuc')) {
    function getClientesRuc()
    {
        return Cliente::where('tipo_documento', 'RUC')->get();
    }
}
if (!function_exists('generarQrApi')) {
    function generarQrApi($comprobante)
    {
        $url = "https://facturacion.apisperu.com/api/v1/sale/qr";
        $client =  new \GuzzleHttp\Client(['verify' => false]);
        $token = EmpresaPersonal::findOrFail(1)->token_sunat;
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);
        $estado = $response->getStatusCode();
        return $response->getBody();
        if ($estado == '200') {
            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}
if (!function_exists('enviarComprobanteapi')) {
    function enviarComprobanteapi($comprobante)
    {
        $url = "https://facturacion.apisperu.com/api/v1/invoice/send";
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $token = EmpresaPersonal::findOrFail(1)->token_sunat;
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);
        $estado = $response->getStatusCode();
        if ($estado == '200') {
            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}
if (!function_exists('generarComprobanteapi')) {
    function generarComprobanteapi($comprobante)
    {
        $url = "https://facturacion.apisperu.com/api/v1/invoice/pdf";
        $client = new \GuzzleHttp\Client(['verify' => false]);
        $token = EmpresaPersonal::findOrFail(1)->token_sunat;
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'Authorization' => "Bearer {$token}"
            ],
            'body'    => $comprobante
        ]);
        $estado = $response->getStatusCode();
        return $response->getBody()->getContents();
        dd($response->getBody()->getContents());
        if ($estado == '200') {
            $resultado = $response->getBody()->getContents();
            json_decode($resultado);
            return $resultado;
        }
    }
}
if (!function_exists('obtenerCorrelativo')) {
    /**
     * @param \App\Models\Configuracion\TipoDocumento $tipoDocumento El tipo de Documento en modelo
     * @return \App\Models\Configuracion\NumeracionConteo
     */
    function obtenerCorrelativo($tipoDocumento)
    {
        $numeracion = $tipoDocumento->numeracionSeleccionada;
        if ($numeracion->conteo()->count() == 0) {
            return NumeracionConteo::create([
                'numeracion_id' => $numeracion->id,
                'correlativo' => $numeracion->correlativo_iniciar
            ]);
        }

        return NumeracionConteo::create(['numeracion_id' => $numeracion->id, 'correlativo' => $numeracion->conteo()->orderBy('created_at', 'desc')->first()->correlativo + 1]);
    }
}
