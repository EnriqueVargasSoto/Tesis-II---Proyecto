<?php

namespace App\Http\Controllers\Facturar;

use App\Http\Controllers\Controller;
use App\Models\Facturar\DetallePagoTarjeta;
use App\Models\Facturar\DocumentoVenta;
use App\Models\Facturar\Pago;
use App\Models\Facturar\PagoEfectivo;
use App\Models\Facturar\Tarjeta;
use App\Models\Ventas\Pedido;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FacturarController extends Controller
{
    public function index()
    {
        $tiempoInicial= date('Y-m-d H:i:s',time());
        return view('Facturar.index',compact('tiempoInicial'));
    }
    public function pago(Request $request)
    {
        DB::beginTransaction();
        try {
            $pedido = Pedido::findOrFail($request->pedido_id);
            $pedido->estado_pedido = 'COBRADO';
            $pedido->save();

            foreach ($pedido->pedidoMesa as $p) {
                $mesa = $p->mesa;
                $mesa->disponibilidad = 'DISPONIBLE';
                $mesa->save();
            }


            $pago = new Pago();
            $pago->pedido_id = $request->pedido_id;
            $pago->empleado_id = Auth::user()->persona->empleado->id;
            $pago->vuelto = $request->vuelto;
            $pago->save();

            if ($request->pago_efectivo != 0) {
                $efectivo = new PagoEfectivo();
                $efectivo->pago_id = $pago->id;
                $efectivo->total = $request->pago_efectivo;
                $efectivo->save();
            }
            if (count($request->tarjetas) != 0) {
                foreach ($request->tarjetas as $key => $value) {
                    $detalleTarjeta = new DetallePagoTarjeta();
                    $detalleTarjeta->tarjeta_id = $value['tarjeta'];
                    $detalleTarjeta->pago_id = $pago->id;
                    $detalleTarjeta->cuenta = $value['numero'];
                    $detalleTarjeta->cantidad = $value['cantidad'];
                    $detalleTarjeta->save();
                }
            }
            // DocumentoVenta
            $total = 0;
            foreach($pedido->detalle as $value) {
                if ($value->estado_pedido != 'PENDIENTE') {
                    $total += $value->cantidad * $value->producto->precio;
                }
            }
            DocumentoVenta::create([
                'cliente_id' => $pedido->cliente_id,
                'pedido_id'=>$pedido->id,
                'estado_documento' => 'PENDIENTE',
                'total' => $total
            ]);
            DB::commit();
        } catch (Exception $e) {
            Log::info($e);
            DB::rollBack();
        }
    }
}
