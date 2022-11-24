<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Mesa;
use App\Models\TipoMesa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MesaController extends Controller
{
    public function getTable(Request $request)
    {
        $tipomesa = TipoMesa::findOrFail($request->id);

        $mesas = $tipomesa->mesas()->where('estado', 'ACTIVO')->get();
        return json_encode($mesas);
    }
    public function store(Request $request)
    {
        $userData = $request->only(['numero']);
        $validator = Validator::make($userData, [
            'numero' => ['required', Rule::unique('mesas', 'numero')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })],
        ], [
            'numero.required' => 'El numero es requerido',
            'numero.unique' => 'El numero ya esta registrado',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $mesa = new Mesa([
            'numero' => $request->numero,
            'descripcion' => $request->descripcion,
            'tipomesa_id' => $request->tipomesa_id,
            'ambiente_id'=>$request->ambiente_id,
            'url_imagen' => $request->file('file')->store('public/Mesas'),
            'nombre_imagen' => $request->file('file')->getClientOriginalName(),

        ]);
        $mesa->save();
        // return response()->json(['Mensaje' => "Exito"]);
    }
    public function editar(Request $request)
    {

        $userData = $request->only(['numero']);
        $validator = Validator::make($userData, [
            'numero' => ['required', Rule::unique('mesas', 'numero')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })->ignore($request->id)],
        ], [
            'numero.required' => 'El numero es requerido',
            'numero.unique' => 'El numero ya esta registrado',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }
        $mesa=Mesa::findOrFail($request->id);
        $mesa->numero=$request->numero;
        $mesa->ambiente_id=$request->ambiente_id;
        $mesa->descripcion=$request->descripcion;

        if($request->file!=null)
        {
        $mesa->url_imagen=$request->file('file')->store('public/Mesas');
        $mesa->nombre_imagen=$request->file('file')->getClientOriginalName();
        }

        $mesa->save();
    }
    public function eliminar(Request $request)
    {
        $mesa = Mesa::findOrFail($request->id);
        $mesa->estado = "ANULADO";
        $mesa->save();
    }
}
