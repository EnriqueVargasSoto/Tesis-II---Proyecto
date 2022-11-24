<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Caja\CajaBillete;
use App\Models\Caja\CajaCentimo;
use App\Models\Caja\CajaMoneda;
use App\Models\Caja\DescuadreCaja;
use App\Models\Mantenimiento\Caja;
use App\Models\Mantenimiento\MovimientoCaja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;

class CajaController extends Controller
{
    public function index(){
        return view('Mantenimiento.Caja.index');
    }
    public function getTable(){
        $cajas=Caja::where('estado', 'ACTIVO')->get();
        return DataTables::of($cajas)->toJson();
    }
    public function generar(){
        $cajas=Caja::get();
        $encontrado=false;
        foreach ($cajas as $key => $caja) {
            if($caja->estado=="ANULADO")
            {
                $caja->estado="ACTIVO";
                $caja->save();
                $encontrado=true;
                break;
            }
        }
        if(!$encontrado)
        {
            $ncajas=Caja::count();
            $caja=new Caja();
            $caja->nombre="Caja N°".($ncajas+1);
            $caja->save();
        }
        return redirect()->route('Caja.index');
    }
    public function eliminar(Request $request, $id)
    {
        $caja=Caja::findOrFail($id);
        $caja->estado="ANULADO";
        $caja->save();
        return redirect()->route('Caja.index');
    }
    public function registrarApertura(Request $request)
    {

        $caja=Caja::findOrFail($request->caja);
        $caja->estado_caja="ABIERTA";
        $caja->save();
        $movimiento=new MovimientoCaja();
        $movimiento->empleado_id=Auth::user()->persona->empleado->id;
        $movimiento->caja_id=$request->caja;
        $movimiento->monto=$request->monto;
        $movimiento->tipo_id=1;
        $movimiento->save();
        foreach ($request->dinero as $key => $value) {
            if($value['tipo']=="billete")
            {
                $caja_billete=new CajaBillete();
                $caja_billete->billete_id=$value['id'];
                $caja_billete->cantidad=$value['cantidad'];
                $caja_billete->mcaja_id=$movimiento->id;
                $caja_billete->save();

            }
            elseif($value['tipo']=="moneda")
            {
                $caja_moneda=new CajaMoneda();
                $caja_moneda->moneda_id=$value['id'];
                $caja_moneda->cantidad=$value['cantidad'];
                $caja_moneda->mcaja_id=$movimiento->id;
                $caja_moneda->save();
            }
            elseif($value['tipo']=="centimo")
            {
                $caja_centimo=new CajaCentimo();
                $caja_centimo->centimo_id=$value['id'];
                $caja_centimo->cantidad=$value['cantidad'];
                $caja_centimo->mcaja_id=$movimiento->id;
                $caja_centimo->save();
            }
        }
    }
    public function registrarCierre(Request $request)
    {
        $mCaja = MovimientoCaja::where('empleado_id', '=', Auth::user()->persona->empleado->id)
        ->where('tipo_id', 1)
        ->orderBy('created_at', 'desc')
        ->first();
        $caja=Caja::findOrFail($mCaja->caja_id);
        $caja->estado_caja="CERRADA";
        $caja->save();
        $movimiento=new MovimientoCaja();
        $movimiento->empleado_id=Auth::user()->persona->empleado->id;
        $movimiento->caja_id=$mCaja->caja_id;
        $movimiento->monto=$request->monto;
        $movimiento->tipo_id=2;
        $movimiento->save();
        if($request->descuadre!=0)
        {
            $descuadre=new DescuadreCaja();
            $descuadre->mcaja_id=$movimiento->id;
            $descuadre->descuadre=$request->descuadre;
            $descuadre->descripcion=$request->descripcion;
            $descuadre->save();
        }
        foreach ($request->dinero as $key => $value) {
            if($value['tipo']=="billete")
            {
                $caja_billete=new CajaBillete();
                $caja_billete->billete_id=$value['id'];
                $caja_billete->cantidad=$value['cantidad'];
                $caja_billete->mcaja_id=$movimiento->id;
                $caja_billete->save();

            }
            elseif($value['tipo']=="moneda")
            {
                $caja_moneda=new CajaMoneda();
                $caja_moneda->moneda_id=$value['id'];
                $caja_moneda->cantidad=$value['cantidad'];
                $caja_moneda->mcaja_id=$movimiento->id;
                $caja_moneda->save();
            }
            elseif($value['tipo']=="centimo")
            {
                $caja_centimo=new CajaCentimo();
                $caja_centimo->centimo_id=$value['id'];
                $caja_centimo->cantidad=$value['cantidad'];
                $caja_centimo->mcaja_id=$movimiento->id;
                $caja_centimo->save();
            }
        }
    }
}
