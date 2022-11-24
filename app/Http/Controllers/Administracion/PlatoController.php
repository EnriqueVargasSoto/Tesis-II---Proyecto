<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlatoResource;
use App\Models\Abastecimiento\DetallePlato;
use App\Models\Plato;
use App\Models\Producto;
use App\Models\TipoPlato;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PlatoController extends Controller
{
    public function getTable(Request $request){
        $tipoPlato = TipoPlato::findOrFail($request->id);

        $platos = $tipoPlato->platos()->where('estado', 'ACTIVO')->with('producto')->get();
        //return $platos->toArray();
        return $platos;
    }
    public function store(Request $request)
    {
        $producto = new Producto([
            'nombre' => $request->nombre,
            'precio' => $request->precio,
            'tipoproducto_id'=>1,//el id 1 es plato , el 2 es bebida,mire el modelo Producto
            'url_imagen' => $request->file('file')->store('public/Platos'),
            'nombre_imagen' => $request->file('file')->getClientOriginalName(),
        ]);
        $producto->save();
        $plato=new Plato([
            'tipoplato_id' => $request->tipoplato_id,
            'producto_id' =>$producto->id
        ]);
        $plato->save();
        $detalle = json_decode($request->detalle);
        foreach ($detalle as $key => $value) {
            $detalle = new DetallePlato();
            $detalle->insumo_id = $value->id;
            $detalle->cantidad = $value->cantidad;
            $detalle->plato_id = $plato->id;
            $detalle->save();
        }
    }
    public function editar(Request $request)
    {

        $plato=Plato::findOrFail($request->id);
        $producto=$plato->producto;
        $producto->nombre = $request->nombre;
        $producto->precio = $request->precio;

        if($request->hasFile('file'))
        {
            $producto->url_imagen= $request->file('file')->store('public/Platos');
            $producto->nombre_imagen = $request->file('file')->getClientOriginalName();
        }
        $producto->save();
        $plato->detallePlato()->delete();
        $detalle = json_decode($request->detalle);
        foreach ($detalle as $key => $value) {
            $detalle = new DetallePlato();
            $detalle->insumo_id = $value->id;
            $detalle->cantidad = $value->cantidad;
            $detalle->plato_id = $plato->id;
            $detalle->save();
        }
    }
    public function eliminar(Request $request)
    {
        $plato = Plato::findOrFail($request->id);
        $plato->estado = "ANULADO";
        $plato->save();
    }
    public function detalle(Request $request){
        $datos=array();
        $detalles=Plato::findOrFail($request->id)->detallePlato;
        foreach ($detalles as $key => $value) {
            array_push($datos,array(
                'id'=>$value->insumo_id,
                'nombre'=>$value->insumo->nombre,
                'unidad'=>$value->insumo->unidad->nombre,
                'cantidad'=>$value->cantidad,
            ));
        }
        return json_encode($datos);
    }
}
