<?php

namespace App\Http\Controllers\Ventas;

use App\Http\Controllers\Controller;
use App\Models\Abastecimiento\TipoBebida;
use App\Models\Ventas\DetallePedido;
use App\Models\Ventas\Pedido;
use App\Models\Ventas\PedidoMesa;
use App\Models\Mesa;
use App\Models\TipoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function index()
    {
        $tiempoInicial= date('Y-m-d H:i:s',time());
        return view('Ventas.Pedido.index',compact('tiempoInicial'));
    }
    public function registrar(Request $request)
    {
        $detallepedido = $request->pedidos;
        $detalleMesa = $request->mesas;
        //$mesa = $request->mesa;
        //----------------------------
        $pedido = new Pedido();
        $pedido->tipo_id = 1;
        $pedido->cliente_id = 1;
        $pedido->estado_pedido = "PENDIENTE";
        $pedido->total = 0;
        $pedido->save();
        $total = 0;
        foreach ($detallepedido as $key => $value) {
            $detalle = new DetallePedido();
            $detalle->pedido_id = $pedido->id;
            $detalle->producto_id = $value['id'];
            $detalle->cantidad = $value['cantidad'];
            $detalle->estado_pedido = 'PENDIENTE';
            $detalle->save();
            $total = $total + ($value['cantidad'] * $value['precio']);
        }
        $pedido->total = $total;
        $pedido->save();
        foreach ($detalleMesa  as $key => $value) {
            $pedidoMesa = new PedidoMesa();
            $pedidoMesa->pedido_id = $pedido->id;
            $pedidoMesa->empleado_id = Auth::user()->persona->empleado->id;
            $pedidoMesa->mesa_id = $value['id'];
            $pedidoMesa->save();

            $m = Mesa::findOrFail($value['id']);
            $m->disponibilidad = 'OCUPADO';
            $m->save();
        }
    }
    public function estadoPedido(Request $request)
    {
        $estado = $request->detalle['estado_pedido'] == 'ENTREGADO' ? 'PENDIENTE' : 'ENTREGADO';
        $detalle = DetallePedido::findOrFail($request->detalle['id']);
        $detalle->estado_pedido = $estado;
        $detalle->save();
    }
    public function tipoAlimento(Request $request)
    {
        if ($request->tipo == 'platos') {
            return TipoPlato::findOrFail($request->id)->platos()->with('producto')->get();
        } else {
            return TipoBebida::findOrFail($request->id)->bebidas()->with('producto')->get();
        }
    }

}
