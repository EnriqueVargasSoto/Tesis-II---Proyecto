<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\TipoEmpleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class TipoEmpleadoController extends Controller
{
    public function index(){
        return view('Administracion.TipoEmpleado.index
        ');
    }
    public function getTable()
    {
        $clientes = TipoEmpleado::where('estado','ACTIVO')->get();
        return DataTables::of($clientes)->toJson();
    }
    public function crear(){
        return view('Administracion.Clientes.create');
    }
    public function store(Request $request)
    {
        $tipoEmpleado=new TipoEmpleado();
        $tipoEmpleado->tipo=$request->tipo;
        $tipoEmpleado->save();
        return redirect()->route('TipoEmpleado.index');

    }
    public function edit($id)
    {

    }
    public function editar(Request $request,$id){
        $tipoEmpleado=TipoEmpleado::findOrFail($id);
        $tipoEmpleado->tipo=$request->tipo;
        $tipoEmpleado->save();
        return redirect()->route('TipoEmpleado.index');
    }
    public function eliminar($id)
    {
        $tipoEmpleado=TipoEmpleado::findOrFail($id);
        $tipoEmpleado->estado="ANULADO";
        $tipoEmpleado->save();
        return redirect()->route('TipoEmpleado.index');
    }
}
