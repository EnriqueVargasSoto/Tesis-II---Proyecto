<?php

namespace App\Http\Controllers\Compras;

use App\Http\Controllers\Controller;
use App\Models\Abastecimiento\Insumo;
use App\Models\Administracion\Proveedor;
use App\Models\Compras\DetalleDocCompra;
use App\Models\Compras\DocCompra;
use App\Models\Mantenimiento\Deposito;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class DocCompraController extends Controller
{
    public function index()
    {

        return view('Compras.DocCompra.index');
    }
    public function getTable()
    {
        $datos = array();
        $docCompras = DocCompra::where('estado', 'ACTIVO')->get();
        foreach ($docCompras as $fila) {
            array_push($datos, array(
                'id' => $fila->id,
                'Proveedor' => $fila->Proveedor->nombre_comercial,
                'Deposito' => $fila->Deposito->nombre,
                'FechaEmision' =>date('Y-m-d', strtotime($fila->fecha_emision)) ,
                'NIgv' => $fila->cantidad_igv,
                'Total' =>number_format($fila->sumTotal->first()->total,2)
            ));
        }
        return DataTables::of($datos)->toJson();
    }
    public function crear()
    {
        $proveedores = Proveedor::where('estado', 'ACTIVO')->get();
        $depositos = Deposito::where('estado', 'ACTIVO')->get();
        $insumos = Insumo::where('estado', 'ACTIVO')->get();
        return view('Compras.DocCompra.create', ['proveedores' => $proveedores, 'depositos' => $depositos, 'insumos' => $insumos]);
    }
    public function store(Request $request)
    {
        $docCompra = new DocCompra();
        $docCompra->proveedor_id = $request->Proveedor;
        $docCompra->deposito_id = $request->Deposito;
        $docCompra->fecha_emision = $request->fecha_emision;
        $docCompra->fecha_entrega = $request->fecha_entrega;
        $docCompra->modo_compra = $request->modo_compra;
        $docCompra->tipo_moneda = $request->tipo_moneda;
        $docCompra->igv = $request->has('igv') == true ? 'Si' : 'No';
        $docCompra->cantidad_igv = $request->has('igv') == true ? $request->cantidad_igv : 0;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            $docCompra->nombre_imagen = $name;
            $docCompra->ruta_imagen = $request->file('logo')->store('public/docCompra');
        }
        $docCompra->save();

        $datos = json_decode($request->arreglo_insumo);


        foreach ($datos as $key => $value) {
            $detalle = new DetalleDocCompra();
            $detalle->insumo_id = $value->id;
            $detalle->doc_compra_id = $docCompra->id;
            $detalle->cantidad = $value->cantidad;
            $detalle->precio = $value->precio;
            $detalle->save();
            $insumo = $detalle->Insumo;
            $insumo->stock += $detalle->cantidad;
            $insumo->save();
        }



        return redirect()->route('DocCompra.index');
    }
    public function edit($id)
    {
        $docCompra = DocCompra::findOrFail($id);
        $proveedores = Proveedor::where('estado', 'ACTIVO')->get();
        $depositos = Deposito::where('estado', 'ACTIVO')->get();
        $insumos = Insumo::where('estado', 'ACTIVO')->get();
        $detalles = $docCompra->Detalle;
        $arregloDetalle = array();
        foreach ($detalles as $key => $detalle) {
            array_push(
                $arregloDetalle,
                array(
                    "id" => $detalle->Insumo->id,
                    "nombre" => $detalle->Insumo->nombre,
                    "precio" => $detalle->precio,
                    "cantidad" => $detalle->cantidad,
                )
            );
        }
        return view('Compras.DocCompra.edit', ['docCompra' => $docCompra, 'proveedores' => $proveedores, 'depositos' => $depositos, 'insumos' => $insumos, 'arreglodetalle' => json_encode($arregloDetalle)]);
    }
    public function editar(Request $request, $id)
    {
        $docCompra = DocCompra::findOrFail($id);
        $docCompra->proveedor_id = $request->Proveedor;
        $docCompra->deposito_id = $request->Deposito;
        $docCompra->fecha_emision = $request->fecha_emision;
        $docCompra->fecha_entrega = $request->fecha_entrega;
        $docCompra->modo_compra = $request->modo_compra;
        $docCompra->tipo_moneda = $request->tipo_moneda;
        $docCompra->igv = $request->has('igv') == true ? 'Si' : 'No';
        $docCompra->cantidad_igv = $request->has('igv') == true ? $request->cantidad_igv : 0;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $name = $file->getClientOriginalName();
            $docCompra->nombre_imagen = $name;
            $docCompra->ruta_imagen = $request->file('logo')->store('public/docCompra');
        }
        $docCompra->save();
        foreach ($docCompra->Detalle as $value) {
            $insumo = $value->Insumo;
            $insumo->stock -= $value->cantidad;
            $insumo->save();
        }
        $docCompra->Detalle()->delete();
        $datos = json_decode($request->arreglo_insumo);


        foreach ($datos as $key => $value) {
            $detalle = new DetalleDocCompra();
            $detalle->insumo_id = $value->id;
            $detalle->doc_compra_id = $docCompra->id;
            $detalle->cantidad = $value->cantidad;
            $detalle->precio = $value->precio;
            $detalle->save();
        }



        return redirect()->route('DocCompra.index');
    }
    public function eliminar($id)
    {
        $docCompra = DocCompra::findOrFail($id);
        $docCompra->estado = "ANULADO";
        $docCompra->save();
        foreach ($docCompra->Detalle as $value) {
            $insumo = $value->Insumo;
            $insumo->stock -= $value->cantidad;
            $insumo->save();
        }
        return redirect()->route('DocCompra.index');
    }
}
