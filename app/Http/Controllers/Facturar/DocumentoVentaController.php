<?php

namespace App\Http\Controllers\Facturar;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Cliente;
use App\Models\EmpresaPersonal;
use App\Models\Facturar\DocumentoVenta;
use App\Models\Mantenimiento\TipoDocumento;
use App\Models\Ventas\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Luecano\NumeroALetras\NumeroALetras;
use stdClass;

class DocumentoVentaController extends Controller
{
    public function index(Request $request)
    {
        return view('Facturar.DocumentoVenta.index');
    }
    public function getTable()
    {
        $documento = DocumentoVenta::with(['cliente'])->get()->filter(function ($documento) {
            $pedido = $documento->pedido;
            // Log::info($pedido->id);
            $documento->efectivo = $pedido->pago->pagoEfectivo?$pedido->pago->pagoEfectivo->total:0;
                        $total = 0;
            foreach ($pedido->pago->pagoTarjeta as $key => $value) {
                $total += $value->cantidad;
            }
            $mesas = "";
            foreach ($pedido->pedidoMesa as $key => $value) {
                $mesas .= "/ Mesa" . $value->mesa->numero;
            }
            $documento->tarjeta = $total;
            $documento->mesas = $mesas;
            $documento->serie = $documento->correlativo == null ? "-" : $documento->correlativo->numeracion->serie . "-" . $documento->correlativo->correlativo;
            return $pedido->pedidoMesa ? true : false;
        });
        return DataTables::of($documento)->toJson();
    }
    public function ticket($id)
    {
        try {
            $documento = DocumentoVenta::findOrFail($id);
            $pedido = $documento->pedido;
            $empresa = EmpresaPersonal::first();
            if ($documento->tipo_documento_id != null) {
                $qr = self::qr_code($documento, $empresa);
                $legends = self::obtenerLeyenda($documento);
                if (!$qr['success']) {
                    Session::flash('error', $qr['mensaje']);
                    return redirect()->back();
                }
            }
            $pdf = PDF::loadView('Facturar.DocumentoVenta.reporte.ticket', compact('pedido', 'empresa', 'documento'))->setPaper([0, 0, 226.772, 651.95]);
            return $pdf->stream();
        } catch (Exception $e) {
            Log::info($e);
            Session::flash('error', $e->getMessage());
            return redirect()->back();
        }
    }
    public static function obtenerLeyenda($documento)
    {
        $formatter = new NumeroALetras();
        $convertir = $formatter->toInvoice($documento->total, 2, 'SOLES');
        //CREAR LEYENDA DEL COMPROBANTE
        $arrayLeyenda = array();
        $arrayLeyenda[] = array(
            "code" => "1000",
            "value" => $convertir
        );
        return $arrayLeyenda;
    }
    /**
     *@param \App\Models\Ventas\DocumentoVenta $documento El Documento de Venta
     *@param \App\Models\Mantenimiento\EmpresaPersonal $empresa La Empresa Personal
     */
    public static function qr_code($documento, $empresa)
    {
        try {
            if ($documento->url_qr == null) {
                $arreglo_qr = array(
                    "ruc" => $empresa->ruc,
                    "tipo" => $documento->cliente->tipo_documento == "DNI" ? '03' : '01',
                    "serie" => $documento->correlativo->numeracion->serie,
                    "numero" => $documento->correlativo->correlativo,
                    "emision" => self::obtenerFechaEmision($documento),
                    "igv" => 18,
                    "total" => (float)$documento->total,
                    "clienteTipo" => $documento->cliente->tipo_documento == "DNI" ? 1 : 6,
                    "clienteNumero" => $documento->cliente->documento
                );
                /********************************/
                $data_qr = generarQrApi(json_encode($arreglo_qr));
                $name_qr =  $documento->correlativo->numeracion->serie . "-" . $documento->correlativo->correlativo . '.svg';
                $pathToFile_qr = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs' . DIRECTORY_SEPARATOR . $name_qr);
                if (!file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs'))) {
                    mkdir(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs'));
                }
                file_put_contents($pathToFile_qr, $data_qr);
                $documento->url_qr = 'public/qrs/' . $name_qr;
                $documento->save();
                return array('success' => true, 'mensaje' => 'QR creado exitosamente');
            } else {
                return array('success' => true, 'mensaje' => 'QR creado exitosamente');
            }
        } catch (Exception $e) {
            Log::info($e);
            return array('success' => false, 'mensaje' => $e->getMessage());
        }
    }
    public static function obtenerFechaEmision($documento)
    {
        $date = strtotime($documento->fecha_registro);
        $fecha_emision = date('Y-m-d', $date);
        $hora_emision = date('H:i:s', $date);
        $fecha = $fecha_emision . 'T' . $hora_emision . '-05:00';
        return $fecha;
    }
    public function facturaStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $consulta = Cliente::where('documento', $request->documento);
            if ($consulta->count() == 0) {
                $cliente = Cliente::create([
                    'nombre' => $request->nombre,
                    'direccion' => $request->direccion,
                    'documento' => $request->documento,
                    'tipo_documento' => 'RUC'
                ]);
            } else {
                $cliente = $consulta->first();
                $cliente->nombre = $request->nombre;
                $cliente->direccion = $request->direccion;
                // $cliente->documento=$request->documento;
                $cliente->save();
            }
            $documento = DocumentoVenta::findOrFail($request->documento_id);
            $documento->correlativo_id = obtenerCorrelativo(TipoDocumento::findOrFail(2))->id;
            $documento->tipo_documento_id = TipoDocumento::findOrFail(2)->id;
            $documento->cliente_id = $cliente->id;
            $documento->estado_documento = "REGISTRADO";
            $documento->save();
            DB::commit();
            return array("success" => true, "data" => $documento);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return array("success" => false, "data" => null);
        }
    }
    public function boletaStore(Request $request)
    {
        DB::beginTransaction();
        try {
            $consulta = Cliente::where('documento', $request->documento);
            if ($consulta->count() == 0) {
                $cliente = Cliente::create([
                    'nombre' => $request->nombre,
                    'direccion' => $request->direccion,
                    'documento' => $request->documento,
                    'tipo_documento' => 'DNI'
                ]);
            } else {
                $cliente = $consulta->first();
                $cliente->nombre = $request->nombre;
                $cliente->direccion = $request->direccion;
                // $cliente->documento=$request->documento;
                $cliente->save();
            }
            $documento = DocumentoVenta::findOrFail($request->documento_id);
            $documento->correlativo_id = obtenerCorrelativo(TipoDocumento::findOrFail(1))->id;
            $documento->tipo_documento_id = TipoDocumento::findOrFail(1)->id;
            $documento->cliente_id = $cliente->id;
            $documento->estado_documento = "REGISTRADO";
            $documento->save();
            DB::commit();
            return array("success" => true, "data" => $documento);
        } catch (Exception $e) {
            DB::rollBack();
            Log::info($e);
            return array("success" => false, "data" => null);
        }
    }
    public function sunat($id)
    {

        try {
            $documento = DocumentoVenta::findorfail($id);
            $empresa = EmpresaPersonal::first();

            //ARREGLO COMPROBANTE
            $arreglo_comprobante = array(
                "tipoOperacion" => "0101",
                "tipoDoc" => $documento->cliente->tipo_documento == "DNI" ? "03" : "01",
                "serie" => $documento->correlativo->numeracion->serie,
                "correlativo" =>  $documento->correlativo->correlativo,
                "fechaEmision" => self::obtenerFechaEmision($documento),
                "formaPago" => array(
                    "moneda" => "PEN",
                    "tipo" => "Contado"
                ),
                "tipoMoneda" => "PEN",
                "client" => array(
                    "tipoDoc" => $documento->cliente->tipo_documento == "DNI" ? 1 : 6,
                    "numDoc" => $documento->cliente->documento,
                    "rznSocial" => $documento->cliente->nombre,
                    // "address" => array(
                    //     "direccion" => $documento->direccion_cliente,
                    // )
                ),
                "company" => array(
                    "ruc" =>  $empresa->ruc,
                    "razonSocial" => $empresa->nombre_comercial,
                    "address" => array(
                        "direccion" => $empresa->direccion,
                    )
                ),
                "mtoOperGravadas" => (float)number_format($documento->total / (1 + 0.18), 2),
                "mtoOperExoneradas" => 0,
                "mtoIGV" => (float) number_format($documento->total - ($documento->total / (1 + 0.18)), 2),
                "valorVenta" => (float)number_format($documento->total / (1 + 0.18), 2),
                "totalImpuestos" => (float)number_format($documento->total - ($documento->total / (1 + 0.18)), 2),
                "subTotal" => (float)number_format($documento->total, 2),
                "mtoImpVenta" => (float)number_format($documento->total, 2),
                "ublVersion" => "2.1",
                "details" => self::obtenerProductos($documento->pedido),
                "legends" =>  self::obtenerLeyenda($documento),
            );

            //OBTENER JSON DEL COMPROBANTE EL CUAL SE ENVIARA A SUNAT

            $data = enviarComprobanteapi(json_encode($arreglo_comprobante));
            // Log::info($arreglo_comprobante);
            // Log::info($data);
            //RESPUESTA DE LA SUNAT EN JSON
            $json_sunat = json_decode($data);
            // $envioSunat = new EnvioSunat();
            // $envioSunat->documento_venta_id = $id;
            if ($json_sunat->sunatResponse->success == true) {
                $documento->estado_documento = 'ACEPTADO';

                $respuesta_cdr = json_encode($json_sunat->sunatResponse->cdrResponse, true);
                // $respuesta_cdr = json_decode($respuesta_cdr,true);
                $documento->cdr_response = $respuesta_cdr;
                $documento->save();

                $data_comprobante = generarComprobanteapi(json_encode($arreglo_comprobante));
                $name = $documento->correlativo->numeracion->serie . "-" .  $documento->correlativo->correlativo . '.pdf';
                $data_cdr = base64_decode($json_sunat->sunatResponse->cdrZip);
                $name_cdr = 'R-' . $documento->correlativo->numeracion->serie . "-" .  $documento->correlativo->correlativo . '.zip';
                if (!file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'sunat'))) {
                    mkdir(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'sunat'));
                }
                if (!file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'cdr'))) {
                    mkdir(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'cdr'));
                }
                $pathToFile = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'sunat' . DIRECTORY_SEPARATOR . $name);
                $pathToFile_cdr = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'cdr' . DIRECTORY_SEPARATOR . $name_cdr);
                file_put_contents($pathToFile, $data_comprobante);
                file_put_contents($pathToFile_cdr, $data_cdr);
                $arreglo_qr = array(
                    "ruc" => $empresa->ruc,
                    "tipo" => $documento->cliente->tipo_documento == "DNI" ? '03' : '01',
                    "serie" => $documento->correlativo->numeracion->serie,
                    "numero" => $documento->correlativo->correlativo,
                    "emision" => self::obtenerFechaEmision($documento),
                    "igv" => 18,
                    "total" => (float)$documento->total,
                    "clienteTipo" => $documento->cliente->tipo_documento == "DNI" ? 1 : 6,
                    "clienteNumero" => $documento->cliente->documento
                );
                /********************************/
                $data_qr = generarQrApi(json_encode($arreglo_qr));
                $name_qr = $documento->correlativo->numeracion->serie . "-" .  $documento->correlativo->correlativo . '.svg';
                $pathToFile_qr = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs' . DIRECTORY_SEPARATOR . $name_qr);
                if (!file_exists(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs'))) {
                    mkdir(storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'qrs'));
                }
                file_put_contents($pathToFile_qr, $data_qr);
                /********************************/
                /********************************* */
                $documento->nombre_comprobante_archivo = $name;
                $documento->url_comprobante_archivo = 'public/sunat/' . $name;
                $documento->url_qr = 'public/qrs/' . $name_qr;
                $documento->hash = $json_sunat->hash;
                $documento->estado_documento = 'ACEPTADO';
                $documento->update();


                // $envioSunat->estado = 'ACEPTADO';
                // $envioSunat->save();
                DB::commit();
                //Registro de actividad
                return array("success" => true, "data" => $documento);
            } else {
                //COMO SUNAT NO LO ADMITE VUELVE A SER 0
                $documento->estado_documento = 'ERROR';
                $documento->update();
                if ($json_sunat->sunatResponse->error) {
                    $obj_erro = new stdClass();
                    $obj_erro->code = $json_sunat->sunatResponse->error->code;
                    $obj_erro->description = $json_sunat->sunatResponse->error->message;
                    $respuesta_error = json_encode($obj_erro, true);
                    $respuesta_error = json_decode($respuesta_error, true);
                    $documento->regularize_response = $respuesta_error;
                } else {
                    $respuesta_error = json_encode($json_sunat->sunatResponse->cdrResponse, true);
                    $respuesta_error = json_decode($respuesta_error, true);
                    $documento->cdr_response = $respuesta_error;
                };
                $documento->update();
                // $envioSunat->estado = "RECHAZADO";
                // $envioSunat->save();
                // $documento->estado_documento = 'FALLO';
                // $documento->update();
                DB::commit();
                // Session::flash('error', 'Documento de Venta sin exito en el envio a sunat.');
                return array("success" => false, "data" => "Documento de Venta sin exito en el envio a sunat.");
            }
            $documento->estado_documento = 'ACEPTADO';
            $documento->update();
            return array("success" => true, "data" => $documento);
        } catch (Exception $e) {
            return array("success" => true, "data" => $documento);
        }
    }
    public static function obtenerProductos($pedido)
    {

        foreach ($pedido->detalle as $key => $value) {
            if ($value->estado_pedido == "ENTREGADO") {
                $producto = $value->producto;
                $arrayProductos[] = array(
                    "codProducto" => ($producto->plato ? "PRO" : "BEB") . $producto->id,
                    "unidad" => "NIU",
                    "descripcion" => $producto->nombre,
                    "cantidad" =>  (float)sprintf("%.2f", (float)$value->cantidad),
                    "mtoValorUnitario" => (float) sprintf("%.2f", (float)($producto->precio / 1.18)),
                    "mtoValorVenta" => (float)sprintf("%.2f", (float)(($producto->precio * $value->cantidad) / 1.18)),
                    "mtoBaseIgv" => (float)sprintf("%.2f", (float)(($producto->precio * $value->cantidad) / 1.18)),
                    "porcentajeIgv" => 18,
                    "igv" => (float) sprintf("%.2f", (float)(($producto->precio * $value->cantidad)  - ($producto->precio * $value->cantidad) / 1.18)),
                    "tipAfeIgv" => 10,
                    "totalImpuestos" => (float) sprintf("%.2f", (float)($producto->precio * $value->cantidad)  - (($producto->precio * $value->cantidad) / 1.18)),
                    "mtoPrecioUnitario" => (float)sprintf("%.2f", (float)$producto->precio)
                );
            }
        }

        return $arrayProductos;
    }
}
