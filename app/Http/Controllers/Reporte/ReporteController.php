<?php

namespace App\Http\Controllers\Reporte;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Empleado;
use App\Models\TipoPedido;
use App\Models\Ventas\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\CarbonPeriod;

class ReporteController extends Controller
{
    public function reportepedidoindex(Request $request)
    {
        $tiempoInicial= date('Y-m-d H:i:s',time());
        $empleados = Empleado::where('tipoempleado_id', 4)->get()->map(function ($empleado) {
            return array("label" => $empleado->persona->nombre . " " . $empleado->persona->apellidoPaterno . " " . $empleado->persona->apellidoMaterno, "id" => $empleado->id);
        });
        $tipoPedidos = TipoPedido::get()->map(function ($tipo) {
            return array("label" => $tipo->tipo_pedido, "id" => $tipo->id);
        });
        return view('Reportes.reportepedido', compact('empleados', 'tipoPedidos','tiempoInicial'));
    }
    public function reportepedidoget(Request $request)
    {
        return DB::table('pedido as p')
            ->when($request->get('empleado_id'), function ($query, $request) {
                return $query->join(
                    DB::raw('(select pm.pedido_id ,pm.empleado_id from pedido_mesa as pm  group by pm.pedido_id,pm.empleado_id) as pdm'),
                    function ($join) {
                        $join->on('p.id', '=', 'pdm.pedido_id');
                    }
                )->join('empleado as e', 'e.id', '=', 'pdm.empleado_id')->select('p.id as pedido_id')->where('e.id', $request);
            })
            ->when(!$request->get('empleado_id'), function ($query, $request) {
                $query->select('p.id as pedido_id');
            })
            ->when($request->get('tipo_pedido'), function ($query, $request) {
                return $query->where('p.tipo_id', $request);
            })->when($request->get('fecha_inicio'), function ($query, $request) {
                return $query->whereDate('p.created_at', '>=', $request);
            })->when($request->get('fecha_final'), function ($query, $request) {
                return $query->whereDate('p.created_at', '<=', $request);
            })->get()->map(function ($pedido) use ($request) {
                $pedido = Pedido::findOrFail($pedido->pedido_id);
                if ($pedido->pedidoMesa->count() != 0) {
                    $persona = $pedido->pedidoMesa()->first()->empleado->persona;
                    $nombre_empleado = $persona->nombre . " " . $persona->apellidoPaterno . " " . $persona->apellidoMaterno;
                } else {
                    $nombre_empleado = "-";
                }
                return array(
                    "id" => $pedido->id,
                    "empleado" => $nombre_empleado,
                    "fecha" => $pedido->created_at->format('Y-m-d h:i'),
                    "tipoPedido" => $pedido->tipo->tipo_pedido,
                    "total" => $pedido->total
                );
            });
    }
    public function reportepedidogetpdf($id)
    {
        $pedido = Pedido::findOrFail($id);
        $pdf = PDF::loadView('Pdf.reportepedido', compact('pedido'));
        return $pdf->stream();
    }
    public function reportePedidoVentaIndex(Request $request)
    {
        $tipoPedidos = TipoPedido::get();
        return view('Reportes.reporteVentasGrafico', compact('tipoPedidos'));
    }
    public function reportePedidoVentaGet(Request $request)
    {
        $fechas = array();
        $data = array();
        $datos = array();
        $rango = CarbonPeriod::create($request->fechaInicio, $request->fechaFinal);
        foreach ($rango as $fecha) {
            $consulta = DB::table('pedido as p')
                ->join('detalle_pedido as dp', 'dp.pedido_id', '=', 'p.id')
                ->join('producto as pr', 'pr.id', '=', 'dp.producto_id')
                ->whereDate('p.created_at', '=', $fecha->format('Y-m-d'))
                ->select(DB::raw('sum(pr.precio*dp.cantidad) as cantidad'))
                ->groupByRaw('date(p.created_at)')->first();
            array_push($fechas, $fecha->format('Y-m-d'));
            array_push($data, $consulta ? $consulta->cantidad : rand(20, 40));
        }
        $datos=array("fechas"=>$fechas,"data"=>$data);
        return $datos;
    }
    public function reportePedidoProductoIndex(Request $request)
    {
        return view('Reportes.reporteProductoGrafico');
    }
    public function reportePedidoProductoGet(Request $request)
    {

            return  DB::table('pedido as p')
                ->join('detalle_pedido as dp', 'dp.pedido_id', '=', 'p.id')
                ->join('producto as pr', 'pr.id', '=', 'dp.producto_id')
                ->whereDate('p.created_at', '>=', $request->fechaInicio)
                ->whereDate('p.created_at', '<=', $request->fechaFinal)
                ->select(DB::raw('sum(dp.cantidad) as cantidad,pr.nombre'))
                ->groupByRaw('pr.nombre')->get();
    }
}
