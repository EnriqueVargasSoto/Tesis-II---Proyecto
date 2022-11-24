<?php

namespace App\Http\Controllers;

use App\Models\Abastecimiento\TipoBebida;
use App\Models\Bebida;
use App\Models\Producto;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    public function getTable(Request $request)
    {
        $tipoBebida = TipoBebida::findOrFail($request->id);

        $bebidas = $tipoBebida->bebidas()->where('estado', 'ACTIVO')->with('producto')->get();
        return $bebidas;
    }
    public function store(Request $request)
    {
        $producto = new Producto([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'tipoproducto_id' => 2, //el id 1 es plato , el 2 es bebida,mire el modelo Producto
            'url_imagen' => $request->file('file')->store('public/Bebidas'),
            'nombre_imagen' => $request->file('file')->getClientOriginalName(),
        ]);
        $producto->save();
        $bebida = new Bebida([
            'tipobebida_id' => $request->tipobebida_id,
            'producto_id' => $producto->id
        ]);
        $bebida->save();
    }
    public function editar(Request $request)
    {

        $bebida = Bebida::findOrFail($request->id);
        $producto = $bebida->producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;

        if ($request->hasFile('file')) {
            $producto->url_imagen = $request->file('file')->store('public/Bebidas');
            $producto->nombre_imagen = $request->file('file')->getClientOriginalName();
        }
        $producto->save();
    }
    public function eliminar(Request $request)
    {
        $bebida = Bebida::findOrFail($request->id);
        $bebida->estado = "ANULADO";
        $bebida->save();
    }
}
