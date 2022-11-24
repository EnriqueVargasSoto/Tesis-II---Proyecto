<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\TipoMesa;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipoMesaController extends Controller
{
    public function index()
    {
        return view('Administracion.TipoMesa.index
        ');
    }
    public function getTable()
    {
        $tipoMesa = TipoMesa::where('estado', 'ACTIVO')->get();
        return DataTables::of($tipoMesa)->toJson();
    }
    public function crear()
    {
        return view('Administracion.Clientes.create');
    }
    public function store(Request $request)
    {
        $tipoMesa = new TipoMesa();
        $tipoMesa->tipo = $request->tipo;
        $tipoMesa->npersonas = $request->npersonas;
        $tipoMesa->save();
        return redirect()->route('TipoMesa.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $tipoMesa = TipoMesa::findOrFail($id);
        $tipoMesa->tipo = $request->tipo;
        $tipoMesa->npersonas = $request->npersonas;
        $tipoMesa->save();
        return redirect()->route('TipoMesa.index');
    }
    public function eliminar($id)
    {
        $tipoMesa = TipoMesa::findOrFail($id);
        $tipoMesa->estado = "ANULADO";
        $tipoMesa->save();
        return redirect()->route('TipoMesa.index');
    }
    public function mesas(Request $request,$id){
        return view('Administracion.TipoMesa.Mesas.index',['id'=>$id]);
    }
}
