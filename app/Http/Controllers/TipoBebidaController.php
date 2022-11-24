<?php

namespace App\Http\Controllers;

use App\Models\Abastecimiento\TipoBebida;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TipoBebidaController extends Controller
{
    public function index()
    {
        return view('Administracion.TipoBebida.index
        ');
    }
    public function getTable()
    {
        $tipoBebida = TipoBebida::where('estado', 'ACTIVO')->get();
        return DataTables::of($tipoBebida)->toJson();
    }
    public function crear()
    {

    }
    public function store(Request $request)
    {
        $tipoBebida = new TipoBebida();
        $tipoBebida->tipo = $request->tipo;
        $tipoBebida->url_imagen=$request->file('logo_create')->store('public/TipoBebidas');
        $tipoBebida->nombre_imagen=$request->file('logo_create')->getClientOriginalName();
        $tipoBebida->save();
        return redirect()->route('TipoBebida.index');
    }
    public function edit($id)
    {
    }
    public function editar(Request $request, $id)
    {
        $tipoBebida = TipoBebida::findOrFail($id);
        $tipoBebida->tipo = $request->tipo;
        if($request->hasFile('logo_editar'))
        {
            $tipoBebida->url_imagen=$request->file('logo_editar')->store('public/TipoBebidas');
            $tipoBebida->nombre_imagen=$request->file('logo_editar')->getClientOriginalName();
        }
        $tipoBebida->save();
        return redirect()->route('TipoBebida.index');
    }
    public function eliminar($id)
    {
        $tipoBebida = TipoBebida::findOrFail($id);
        $tipoBebida->estado = "ANULADO";
        $tipoBebida->save();
        return redirect()->route('TipoBebida.index');
    }
    public function bebidas(Request $request,$id){
        return view('Administracion.TipoBebida.Bebidas.index',['id'=>$id]);
    }
}
