<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use App\Models\Mantenimiento\Deposito;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DepositoController extends Controller
{
    public function index()
    {
        return view('Mantenimiento.Deposito.index');
    }
    public function getTable()
    {
        $deposito = Deposito::where('estado', 'ACTIVO')->get();
        return DataTables::of($deposito)->toJson();
    }
    public function crear()
    {
    }
    public function store(Request $request)
    {
        $deposito = new Deposito();
        $deposito->nombre = $request->nombre;
        $deposito->descripcion = $request->descripcion;
        $deposito->save();
        return redirect()->route('Deposito.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $deposito = Deposito::findOrFail($id);
        $deposito->nombre = $request->nombre;
        $deposito->descripcion = $request->descripcion;
        $deposito->save();
        return redirect()->route('Deposito.index');
    }
    public function eliminar($id)
    {
        $deposito = Deposito::findOrFail($id);
        $deposito->estado = "ANULADO";
        $deposito->save();
        return redirect()->route('Deposito.index');
    }
}
