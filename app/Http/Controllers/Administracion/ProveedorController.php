<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProveedorController extends Controller
{
    public function index()
    {
        return view('Administracion.Proveedor.index');
    }
    public function getTable()
    {
        $proveedor = Proveedor::where('estado', 'ACTIVO')->get();
        return DataTables::of($proveedor)->toJson();
    }
    public function crear()
    {
        return view('Administracion.Proveedor.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'nombre_comercial' => 'required',
            'numero_documento' => ['required', 'numeric', Rule::unique('proveedor', 'numero_documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })],
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
        ];
        $message = [
            'nombre_comercial.required' => 'El Campo Nombre es Obligatorio',
            'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'numero_documento.numeric' => 'El Campo numero_documento debe ser numerico',
            'numero_documento.unique' => 'El Campo numero_documento ya esta registrado',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',

        ];

        Validator::make($data, $rules, $message)->validate();
        $proveedor = new Proveedor();
        $proveedor->nombre_comercial = $request->nombre_comercial;
        $proveedor->numero_documento = $request->numero_documento;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        return redirect()->route('Proveedor.index');
    }
    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        return view('Administracion.Proveedor.edit', ['proveedor' => $proveedor, 'id' => $id]);
    }
    public function editar(Request $request, $id)
    {
        $data = $request->all();

        $rules = [
            'nombre_comercial' => 'required',
            'numero_documento' => ['required', 'numeric', Rule::unique('proveedor', 'numero_documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })->ignore($id)],
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
        ];
        $message = [
            'nombre_comercial.required' => 'El Campo Nombre es Obligatorio',
            'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'numero_documento.numeric' => 'El Campo numero_documento debe ser numerico',
            'numero_documento.unique' => 'El Campo numero_documento ya esta registrado',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',


        ];

        Validator::make($data, $rules, $message)->validate();
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->nombre_comercial = $request->nombre_comercial;
        $proveedor->numero_documento = $request->numero_documento;
        $proveedor->telefono = $request->telefono;
        $proveedor->direccion = $request->direccion;
        $proveedor->save();
        return redirect()->route('Proveedor.index');
    }
    public function eliminar($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->estado = "ANULADO";
        $proveedor->save();
        return redirect()->route('Proveedor.index');
    }
}
