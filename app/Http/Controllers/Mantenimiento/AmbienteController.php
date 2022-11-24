<?php

namespace App\Http\Controllers\Mantenimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mantenimiento\Ambiente;
use Yajra\DataTables\Facades\DataTables;

class AmbienteController extends Controller
{
    public function index(){
        return view('Mantenimiento.Ambiente.index');
    }
    public function getTable()
    {
        $ambiente = Ambiente::where('estado', 'ACTIVO')->get();
        return DataTables::of($ambiente)->toJson();
    }
    public function crear()
    {

    }
    public function store(Request $request)
    {
        $ambiente = new Ambiente();
        $ambiente->nombre = $request->nombre;
        $ambiente->save();
        return redirect()->route('Ambiente.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $ambiente = Ambiente::findOrFail($id);
        $ambiente->nombre = $request->nombre;
        $ambiente->save();
        return redirect()->route('Ambiente.index');
    }
    public function eliminar($id)
    {
        $ambiente = Ambiente::findOrFail($id);
        $ambiente->estado = "ANULADO";
        $ambiente->save();
        return redirect()->route('Ambiente.index');
    }
}
