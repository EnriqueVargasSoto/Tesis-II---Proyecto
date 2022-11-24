<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\TipoPlato;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipoPlatoController extends Controller
{
    public function index()
    {
        return view('Administracion.TipoPlato.index
        ');
    }
    public function getTable()
    {
        $tipoplato = TipoPlato::where('estado', 'ACTIVO')->get();
        return DataTables::of($tipoplato)->toJson();
    }
    public function store(Request $request)
    {
        $tipoplato = new TipoPlato();
        $tipoplato->tipo = $request->tipo;
        $tipoplato->url_imagen=$request->file('logo_create')->store('public/TipoPlatos');
        $tipoplato->nombre_imagen=$request->file('logo_create')->getClientOriginalName();
        $tipoplato->save();
        return redirect()->route('TipoPlato.index');
    }
    public function editar(Request $request, $id)
    {
        $tipoplato = TipoPlato::findOrFail($id);
        $tipoplato->tipo = $request->tipo;
        if($request->hasFile('logo_editar'))
        {
            $tipoplato->url_imagen=$request->file('logo_editar')->store('public/TipoPlatos');
            $tipoplato->nombre_imagen=$request->file('logo_editar')->getClientOriginalName();
        }
        $tipoplato->save();
        return redirect()->route('TipoPlato.index');
    }
    public function eliminar($id)
    {
        $tipoplato = TipoPlato::findOrFail($id);
        $tipoplato->estado = "ANULADO";
        $tipoplato->save();
        return redirect()->route('TipoPlato.index');
    }
    public function platos(Request $request,$id){
        return view('Administracion.TipoPlato.Platos.index',['id'=>$id]);
    }
}
