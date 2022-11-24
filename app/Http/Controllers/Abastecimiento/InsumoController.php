<?php

namespace App\Http\Controllers\Abastecimiento;

use App\Http\Controllers\Controller;
use App\Models\Abastecimiento\Insumo;
use App\Models\Abastecimiento\Unidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class InsumoController extends Controller
{
    public function index()
    {
        $unidades=Unidad::get();
        return view('Abastecimiento.Insumos.index',['unidades'=>$unidades]);
    }
    public function getTable()
    {
        $datos=array();
        $insumo = Insumo::where('estado', 'ACTIVO')->get();
        foreach ($insumo as $fila) {
            array_push($datos,array(
                'id'=>$fila->id,
                'nombre' => $fila->nombre,
                'stock'=>$fila->stock,
                'unidad_id'=>$fila->unidad_id,
                'precio'=>$fila->precio,
                'unidad'=>$fila->unidad->nombre,));
        }

        return DataTables::of($datos)->toJson();
    }
    public function crear()
    {

    }
    public function store(Request $request)
    {
        $insumo = new Insumo();
        $insumo->nombre = $request->nombre;
        $insumo->stock = $request->stock;
        $insumo->unidad_id = $request->unidad;
        $insumo->precio= $request->precio;
        $insumo->save();
        return redirect()->route('Insumo.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->nombre = $request->nombre;
        $insumo->stock = $request->stock;
        $insumo->unidad_id = $request->unidad;
        $insumo->precio = $request->precio;
        $insumo->save();
        return redirect()->route('Insumo.index');
    }
    public function eliminar($id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->estado = "ANULADO";
        $insumo->save();
        return redirect()->route('Insumo.index');
    }
}
