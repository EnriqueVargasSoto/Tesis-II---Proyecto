<?php

namespace App\Http\Controllers\Consultas;

use App\Http\Controllers\Controller;
use App\Models\Abastecimiento\Insumo;
use App\Models\Administracion\Cliente;
use App\Models\Administracion\Empleado;
use App\Models\Administracion\Persona;
use App\Models\Facturar\Billete;
use App\Models\Facturar\Centimo;
use App\Models\Facturar\Moneda;
use App\Models\Facturar\Pago;
use App\Models\Facturar\Tarjeta;
use App\Models\Facturar\TipoTarjeta;
use App\Models\Ventas\PedidoMesa;
use App\Models\Mantenimiento\Ambiente;
use App\Models\Mantenimiento\Caja;
use App\Models\Mantenimiento\MovimientoCaja;
use App\Models\Mesa;
use App\Models\Plato;
use App\Models\Producto;
use App\Models\Ventas\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;

class ConsultaController extends Controller
{
    public function ambientes()
    {
        $ambientes = Ambiente::get();
        return json_encode($ambientes);
    }
    public function insumos()
    {
        $insumos = Insumo::where('estado', 'ACTIVO')->with(['unidad'])->get();
        return json_encode($insumos);
    }
    public function verificarCaja()
    {
        $cajas = Caja::where('estado_caja', 'CERRADA')->get();
        $mensaje = array("datos" => array(), "mensaje" => "vacio");
        if (Auth::user()->persona->empleado->tipo->tipo == "Cajero") {
            $mensaje = array("datos" => $cajas, "mensaje" => "Sin Aperturar");
            $movimientos = MovimientoCaja::where('empleado_id', Auth::user()->persona->empleado->id)->get();
            foreach ($movimientos as $key => $movimiento) {
                if ($movimiento->caja->estado_caja == 'ABIERTA') {
                    $mensaje = array("datos" => $movimiento->caja, "mensaje" => "Aperturada");;
                    break;
                }
            }
        }
        return $mensaje;
    }
    public function pedidosMesas($estado)
    {
        $datos = array();
        $pedidos = Pedido::where('estado_pedido', $estado)->where('tipo_id', 1)->get();

        foreach ($pedidos as $key => $pedido) {

            $pedidoMesa = $pedido->pedidoMesa()->first();
            $productos = array();
            foreach ($pedidoMesa->pedido->detalle as $keyfila => $detalle) {
                array_push($productos, $detalle->producto);
            }
            array_push($datos, array(
                "id" => $pedido->id,
                "pedidoMesa" => $pedidoMesa,
                "mesa" => $pedidoMesa->mesa,
                "detalles" => $pedidoMesa->pedido->detalle,
                "total_estado" => $pedidoMesa->pedido->total(),
                "productos" => $productos
            ));
        }
        return $datos;
    }
    public function pedidosDelivery($estado)
    {
        $pedidos = Pedido::where('estado_pedido', $estado)->where('tipo_id', 2)->get()->map(function ($pedido) {
            return array(
                "id" => $pedido->id,
                "total" => $pedido->total,
                "total_estado" => $pedido->total(),
                "estado_pedido" => $pedido->estado_pedido,
                "seleccionar" => false,
                "detalle" => $pedido->detalle()->get()->map(function ($detalle) {
                    return array(
                        "id" => $detalle->id,
                        "cantidad" => $detalle->cantidad,
                        "descripcion" => $detalle->descripcion,
                        "estado_pedido" => $detalle->estado_pedido,
                        "producto" => $detalle->producto,
                    );
                })
            );
        });

        return $pedidos;
    }
    public function platos()
    {
        $platos = Plato::where('estado', 'ACTIVO')->get();
        return json_encode($platos);
    }
    public function mesas()
    {
        $mesas = Mesa::where('estado', 'ACTIVO')->get();
        return $mesas;
    }
    public function monedas()
    {
        return Moneda::get();
    }
    public function billetes()
    {
        return Billete::get();
    }
    public function centimos()
    {
        return Centimo::get();
    }
    public function tipoTarjeta()
    {
        return TipoTarjeta::get();
    }
    public function tarjetas($tipo)
    {
        return TipoTarjeta::findOrFail($tipo)->tarjetas;
    }
    public function tarjetasConsumo()
    {
        $tarjetas = Tarjeta::get();
        $datos = array();
        $movimiento = MovimientoCaja::where('empleado_id', '=', Auth::user()->persona->empleado->id)
            ->where('tipo_id', 1)
            ->orderBy('created_at', 'desc')
            ->first();
        foreach ($tarjetas as $key => $tarjeta) {
            $consulta = DB::table('pago as p')
                ->join('empleado as e', 'e.id', '=', 'p.empleado_id')
                ->join('detalle_tarjeta as dt', 'dt.pago_id', '=', 'p.id')
                ->join('tarjeta as t', 't.id', '=', 'dt.tarjeta_id')
                ->select('t.tarjeta', DB::raw('sum(dt.cantidad) as cantidad'))
                ->where('e.id', '=', Auth::user()->persona->empleado->id)
                ->where('t.id', $tarjeta->id)
                ->where('p.created_at', '>=', $movimiento->created_at)
                ->groupBy('t.tarjeta');
            $resultado = $consulta->count() == 0 ? 0 : $consulta->first()->cantidad;
            array_push($datos, array(
                "id" => $tarjeta->id,
                "tarjeta" => $tarjeta->tarjeta,
                "cantidad" => $resultado
            ));
        }
        return $datos;
    }
    public function getVentas()
    {
        $consultaApertura = MovimientoCaja::where('empleado_id', '=', Auth::user()->persona->empleado->id)
            ->where('tipo_id', 1)
            ->orderBy('created_at', 'desc')
            ->first();
        $saldoApertura = $consultaApertura->monto;
        $consulta = DB::table('pago as p')
            ->join('empleado as e', 'e.id', '=', 'p.empleado_id')
            ->join('pago_efectivo as pe', 'pe.pago_id', '=', 'p.id')
            ->select(DB::raw('sum(pe.total) as cantidad'))
            ->where('e.id', '=', Auth::user()->persona->empleado->id)
            ->where('p.created_at', '>=', $consultaApertura->created_at);
        $ventaEfectivo = $consulta->count() == 0 ? 0 : $consulta->first()->cantidad;

        $datos = array(
            "ventaEfectivo" => $ventaEfectivo,
            "saldoApertura" => $saldoApertura,
        );
        return $datos;
    }
    public function reporteAdmin()
    {
        $cantidadClientes = Cliente::where('estado', 'ACTIVO')->where('id', '!=', 1)->count();
        $cantidadEmpleados = Persona::count();
        $cantidadOrdenes = Pedido::where('estado', 'ACTIVO')->count();
        return array(
            "cantidadClientes" => $cantidadClientes,
            "cantidadEmpleados" => $cantidadEmpleados,
            "cantidadOrdenes" => $cantidadOrdenes
        );
    }
    public function getTotalEstadoPedido($pedido)
    {
        return Pedido::findOrFail($pedido)->total();
    }
    public function getClienteMasPedidos(Request $request)
    {
        return DB::table("pedido as p")
            ->join("clientes as cl", "cl.id", "=", "p.cliente_id")
            ->selectRaw("cl.id,sum(p.total) as gasto")
            ->when($request->tipo, function ($query) use ($request) {
                return $query->where("p.tipo_id", $request->tipo);
            })
            ->where("p.estado_pedido", "ENTREGADO")
            ->when($request->fecha_inicio, function ($query) use ($request) {
                return $query->whereDate("p.created_at", ">=", $request->fecha_inicio);
            })
            ->when($request->fecha_final, function ($query) use ($request) {
                return $query->whereDate("p.created_at", "<=", $request->fecha_final);
            })
            ->groupBy("cl.id")->get()->map(function ($value) {
                $datos = Cliente::findOrFail($value->id);
                $datos->gasto = $value->gasto;
                $datos->fechaInical = Pedido::where('cliente_id', $value->id)->orderBy('created_at', 'asc')->first()->created_at;
                $datos->fechaFinal = Pedido::where('cliente_id', $value->id)->orderBy('created_at', 'desc')->first()->created_at;
                unset($datos->estado);
                unset($datos->created_at);
                unset($datos->update_at);
                return $datos;
            });
    }
    public function getProductosMasVendidos(Request $request)
    {
        return DB::table("pedido as p")
            ->join("detalle_pedido as dp", "dp.pedido_id", "=", "p.id")
            ->join("producto as pr", "pr.id", "=", "dp.producto_id")
            ->selectRaw("pr.id,count(pr.id) as cantidad ")
            ->groupBy('pr.id')
            ->get()->map(function ($producto) {
                $producto = Producto::findOrFail($producto->id);
                return $producto;
            });
    }
    public function getReportesVentasGraph(Request $request)
    {
        $datos = array();
        for ($i = 1; $i < 13; $i++) {
            $consulta = DB::table("pedido as p")
                ->join("detalle_pedido as dp", "dp.pedido_id", "=", "p.id")
                ->join("producto as pr", "pr.id", "=", "dp.producto_id")
                ->selectRaw("sum(dp.cantidad*pr.precio) as total")
                ->whereMonth('p.created_at', $i)
                ->whereYear('p.created_at', $request->year)
                ->where('dp.estado_pedido', 'ENTREGADO')
                ->groupByRaw("MONTH(p.created_at)");
            $total = $consulta->count() == 0 ? rand(20, 40) : $consulta->first()->total;
            array_push($datos, $total);
        }

        return $datos;
    }
    public function getReportesTarjetasGraph(Request $request)
    {
        return Tarjeta::get()->map(function ($tarjeta) use ($request) {
            $consulta = DB::table('pago as p')
                ->join('detalle_tarjeta as dt', 'dt.pago_id', '=', 'p.id')
                ->join('tarjeta as t', 't.id', '=', 'dt.tarjeta_id')
                ->selectRaw('sum(dt.cantidad) as cantidad')
                ->where('t.id', $tarjeta->id)
                ->when($request->get('year'), function ($query, $request) {
                    return $query->whereYear('p.created_at', $request);
                })
                ->groupBy('t.tarjeta');
            $cantidad = $consulta->count() == 0 ? 0 : $consulta->first()->cantidad;
            return array("tarjeta" => $tarjeta->tarjeta, "dinero" => $cantidad);
        });
    }
    public function getReportesProductosGraph(Request $request)
    {
        return  Producto::where('tipoproducto_id', $request->tipoproducto_id)
            ->get()->map(function ($producto) use ($request) {
                $meses = array();

                for ($i = 1; $i < 13; $i++) {
                    $consulta = DB::table("pedido as p")
                        ->join("detalle_pedido as dp", "dp.pedido_id", "=", "p.id")
                        ->join("producto as pr", "pr.id", "=", "dp.producto_id")
                        ->selectRaw("sum(dp.cantidad) as total")
                        ->when($request->get('year'), function ($query, $request) {
                            return $query->whereYear('p.created_at', $request);
                        })
                        ->whereMonth('p.created_at', $i)
                        ->where('dp.estado_pedido', 'ENTREGADO')
                        ->where('pr.id', $producto->id)
                        ->groupByRaw("MONTH(p.created_at)");
                    $cantidad = $consulta->count() == 0 ? rand(20, 40) : $consulta->first()->total;
                    array_push($meses, (float)$cantidad);
                }
                return array("Producto" => $producto->nombre, "Meses" => $meses);
            });
    }
    public function getReportesEmpleadoGraph(Request $request)
    {
        $consulta = DB::table('pedido as p')
            ->join(
                DB::raw('(select pm.pedido_id ,pm.empleado_id from pedido_mesa as pm  group by pm.pedido_id,pm.empleado_id) as pdm'),
                function ($join) {
                    $join->on('p.id', '=', 'pdm.pedido_id');
                }
            )->join('detalle_pedido as dp', 'dp.pedido_id', '=', 'p.id')
            ->join('empleado as e', 'e.id', '=', 'pdm.empleado_id')
            ->join('producto as pr', 'pr.id', '=', 'dp.producto_id')
            ->selectRaw('e.id,sum(dp.cantidad*pr.precio) as totalingreso')
            ->where('dp.estado_pedido', 'ENTREGADO')
            ->groupBy('e.id');
        return $consulta->orderBy('totalingreso', 'DESC')->take(3)->get()->map(function ($empleado) use ($request) {

            $data = Empleado::findOrFail($empleado->id);
            $meses = array();

            for ($i = 1; $i < 13; $i++) {
                $consulta = DB::table('pedido as p')
                    ->join(
                        DB::raw('(select pm.pedido_id ,pm.empleado_id from pedido_mesa as pm  group by pm.pedido_id,pm.empleado_id) as pdm'),
                        function ($join) {
                            $join->on('p.id', '=', 'pdm.pedido_id');
                        }
                    )->join('detalle_pedido as dp', 'dp.pedido_id', '=', 'p.id')
                    ->join('empleado as e', 'e.id', '=', 'pdm.empleado_id')
                    ->join('producto as pr', 'pr.id', '=', 'dp.producto_id')
                    ->selectRaw('sum(dp.cantidad*pr.precio) as cantidad')
                    ->where('dp.estado_pedido', 'ENTREGADO')
                    ->when($request->get('year'), function ($query, $request) {
                        return $query->whereYear('p.created_at', $request);
                    })
                    ->whereMonth('p.created_at', $i)
                    ->where('e.id', $empleado->id)
                    ->groupByRaw("MONTH(p.created_at)");
                $cantidad = $consulta->count() == 0 ? rand(10, 40) : $consulta->first()->cantidad;
                array_push($meses, (float)$cantidad);
            }
            // Log::info($mes);
            return array("Empleado" => $data->persona->nombre . " " .
                $data->persona->apellidoPaterno . " " .
                $data->persona->apellidoMaterno, "Meses" => $meses);
        });
    }
    public function getHelp(Request $request)
    {
        $file = public_path() . "/pdf/help.pdf";
        $headers = array(
            'Content-Type: application/pdf',
        );
        return Response::download($file, 'help.pdf', $headers);
    }
}
