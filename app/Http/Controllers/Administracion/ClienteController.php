<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ClienteController extends Controller
{
    public function index()
    {
        return view('Administracion.Clientes.index');
    }
    public function getTable()
    {
        $clientes = Cliente::where('estado', 'ACTIVO')->get();
        return DataTables::of($clientes)->toJson();
    }
    public function crear()
    {
        return view('Administracion.Clientes.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'nombre' => 'required',
            'documento' => ['required', 'numeric', Rule::unique('clientes', 'documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })],
            'tipo_documento' => 'required',
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
            'email' => 'required',
        ];
        $message = [
            'nombre.required' => 'El Campo Nombre es Obligatorio',
            'tipo_documento.required' => 'El Campo tipo documento es Obligatorio',
            'documento.required' => 'El Campo documento es Obligatorio',
            'documento.numeric' => 'El Campo documento debe ser numerico',
            'documento.unique' => 'El Campo documento ya esta registrado',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'email.required' => 'El Campo email es Obligatorio',
        ];

        Validator::make($data, $rules, $message)->validate();
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->documento = $request->documento;
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return redirect()->route('Clientes.index');
    }
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('Administracion.Clientes.edit', ['cliente' => $cliente, 'id' => $id]);
    }
    public function editar(Request $request, $id)
    {
        $data = $request->all();

        $rules = [
            'nombre' => 'required',
            'documento' => ['required', 'numeric', Rule::unique('clientes', 'documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })->ignore($id)],
            'tipo_documento' => 'required',
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
            'email' => 'required',
        ];
        $message = [
            'nombre.required' => 'El Campo Nombre es Obligatorio',
            'tipo_documento.required' => 'El Campo tipo documento es Obligatorio',
            'documento.required' => 'El Campo documento es Obligatorio',
            'documento.numeric' => 'El Campo documento debe ser numerico',
            'documento.unique' => 'El Campo documento ya esta registrado',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'email.required' => 'El Campo email es Obligatorio',


        ];

        Validator::make($data, $rules, $message)->validate();
        $cliente = Cliente::findOrFail($id);
        $cliente->nombre = $request->nombre;
        $cliente->documento = $request->documento;
        $cliente->tipo_documento = $request->tipo_documento;
        $cliente->email = $request->email;
        $cliente->telefono = $request->telefono;
        $cliente->direccion = $request->direccion;
        $cliente->save();
        return redirect()->route('Clientes.index');
    }
    public function eliminar($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->estado = "ANULADO";
        $cliente->save();
        return redirect()->route('Clientes.index');
    }
}
