<?php

namespace App\Http\Controllers\Abastecimiento;

use App\Http\Controllers\Controller;
use App\Models\Abastecimiento\Unidad;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UnidadController extends Controller
{
    public function index()
    {
        return view('Abastecimiento.Unidades.index');
    }
    public function getTable()
    {
        $unidad = Unidad::where('estado', 'ACTIVO')->get();
        return DataTables::of($unidad)->toJson();
    }
    public function crear()
    {
    }
    public function store(Request $request)
    {
        $unidad = new Unidad();
        $unidad->nombre = $request->nombre;
        $unidad->simbolo = $request->simbolo;
        $unidad->save();
        return redirect()->route('Unidad.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->nombre = $request->nombre;
        $unidad->simbolo = $request->simbolo;
        $unidad->save();
        return redirect()->route('Unidad.index');
    }
    public function eliminar($id)
    {
        $unidad = Unidad::findOrFail($id);
        $unidad->estado = "ANULADO";
        $unidad->save();
        return redirect()->route('Unidad.index');
    }
}
