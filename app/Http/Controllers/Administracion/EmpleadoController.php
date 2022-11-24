<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Administracion\Empleado;
use App\Models\Administracion\Persona;
use App\Models\Administracion\TipoEmpleado;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class EmpleadoController extends Controller
{
    public function index()
    {
        return view('Administracion.Empleado.index');
    }
    public function getTable()
    {
        $empleados = Empleado::get();
        $datos = collect([]);
        foreach ($empleados as $empleado) {
            if ($empleado->persona->estado == "ACTIVO") {
                $datos->push([
                    "id" => $empleado->id,
                    "nombre" => $empleado->persona->nombre,
                    "apellidoPaterno" => $empleado->persona->apellidoPaterno,
                    "apellidoMaterno" => $empleado->persona->apellidoMaterno,
                    "numero_documento" => $empleado->persona->numero_documento,
                    "direccion" => $empleado->persona->direccion,
                    "telefono" => $empleado->persona->telefono,
                    "fechaNacimiento" => $empleado->persona->fechaNacimiento,
                    "edad" => $empleado->persona->edad,
                    "genero" => $empleado->persona->genero,
                    "estadoCivil" => $empleado->persona->estadoCivil,
                    "email" => $empleado->persona->user->email,
                    "tipoEmpleado" => $empleado->tipo->tipo
                ]);
            }
        }
        return DataTables::of($datos)->toJson();
    }
    public function crear()
    {
        return view('Administracion.Empleado.create');
    }
    public function store(Request $request)
    {
        $data = $request->all();

        $rules = [
            'nombre' => 'required',
            'numero_documento' => ['required', 'numeric', Rule::unique('persona', 'numero_documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })],
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
            'fechaNacimiento' => 'required',
            'edad' => ['required', 'numeric'],
            'estadoCivil' => 'required',
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->where(function ($query) {
            })],
            'password' => ['required', 'same:confirmpassword'],
            'confirmpassword' => 'required',
        ];
        $message = [
            'nombre.required' => 'El Campo Nombre es Obligatorio',
            'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'numero_documento.numeric' => 'El Campo numero_documento debe ser numerico',
            'numero_documento.unique' => 'El Campo numero_documento ya esta registrado',
            'apellidoPaterno.required' => 'El Campo apellido Paterno es Obligatorio',
            'apellidoMaterno.required' => 'El Campo apellido Materno es Obligatorio',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'fechaNacimiento.required' => 'El Campo Fecha es Obligatorio',
            'edad.numeric' => 'El Campo edad debe ser numerico',
            'edad.required' => 'El Campo edad es Obligatorio',
            'estadoCivil.required' => 'El Campo estado Civil es Obligatorio',
            'email.required' => 'El Campo email es Obligatorio',
            'email.unique' => 'El Campo email ya esta registrado',
            'email.email' => 'formato no valido',
            'password.required' => 'El Campo password es Obligatorio',
            'password.same' => 'No coinciden los campos de contraseña',
            'confirmpassword.required' => 'El Campo password es Obligatorio',


        ];

        Validator::make($data, $rules, $message)->validate();
        $user = new User();
        $user->name = $request->nombre;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();
        $templeado = TipoEmpleado::findOrFail($request->tipoempleado);
        $rol = DB::table('roles')->where('name', $templeado->tipo)->first();
        $user->roles()->sync([$rol->id]);

        $persona = new Persona();
        $persona->nombre = $request->nombre;
        $persona->apellidoPaterno = $request->apellidoPaterno;
        $persona->apellidoMaterno = $request->apellidoMaterno;
        $persona->numero_documento = $request->numero_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->fechaNacimiento = $request->fechaNacimiento;
        $persona->edad = $request->edad;
        $persona->genero = $request->genero;
        $persona->estadoCivil = $request->estadoCivil;
        $persona->user_id = $user->id;
        $persona->save();

        $empleado = new Empleado();
        $empleado->persona_id = $persona->id;
        $empleado->tipoempleado_id = $request->tipoempleado;
        $empleado->save();

        return redirect()->route('Empleados.index');
    }
    public function edit($id)
    {
        $empleado = Empleado::findOrFail($id);
        return view('Administracion.Empleado.edit', ['empleado' => $empleado, 'id' => $id]);
    }
    public function editar(Request $request, $id)
    {
        $data = $request->all();

        $rules = [
            'nombre' => 'required',
            'numero_documento' => ['required', 'numeric', Rule::unique('persona', 'numero_documento')->where(function ($query) {
                $query->whereIn('estado', ["ACTIVO"]);
            })->ignore(Empleado::findOrFail($id)->persona->id)],
            'apellidoPaterno' => 'required',
            'apellidoMaterno' => 'required',
            'telefono' => ['required', 'numeric'],
            'direccion' => 'required',
            'fechaNacimiento' => 'required',
            'edad' => ['required', 'numeric'],
            'estadoCivil' => 'required',
            'email' => ['required', 'email:rfc,dns', Rule::unique('users', 'email')->where(function ($query) {
            })->ignore(Empleado::findOrFail($id)->persona->user->id)],
            'password' => ['same:confirmpassword']
        ];
        $message = [
            'nombre.required' => 'El Campo Nombre es Obligatorio',
            'numero_documento.required' => 'El Campo numero_documento es Obligatorio',
            'numero_documento.numeric' => 'El Campo numero_documento debe ser numerico',
            'numero_documento.unique' => 'El Campo numero_documento ya esta registrado',
            'apellidoPaterno.required' => 'El Campo apellido Paterno es Obligatorio',
            'apellidoMaterno.required' => 'El Campo apellido Materno es Obligatorio',
            'telefono.required' => 'El Campo telefono es Obligatorio',
            'telefono.numeric' => 'El Campo telefono debe ser numerico',
            'direccion.required' => 'El Campo direccion es Obligatorio',
            'fechaNacimiento.required' => 'El Campo Fecha es Obligatorio',
            'edad.numeric' => 'El Campo edad debe ser numerico',
            'edad.required' => 'El Campo edad es Obligatorio',
            'estadoCivil.required' => 'El Campo estado Civil es Obligatorio',
            'email.required' => 'El Campo email es Obligatorio',
            'email.unique' => 'El Campo email ya esta registrado',
            'email.email' => 'formato no valido',
            'password.same' => 'No coinciden los campos de contraseña',


        ];

        Validator::make($data, $rules, $message)->validate();

        $empleado = Empleado::findOrFail($id);
        $user = User::findOrFail($empleado->persona->user->id);
        if ($request->get('password')) {

            $user->password = bcrypt($request->password);
            $user->save();
        }
        $templeado = TipoEmpleado::findOrFail($request->tipoempleado);
        $rol = DB::table('roles')->where('name', $templeado->tipo)->first();
        $user->roles()->sync([$rol->id]);
        $user->name=$request->nombre;
        $user->save();
        $persona = Persona::findOrFail($empleado->persona->id);
        $persona->nombre = $request->nombre;
        $persona->apellidoPaterno = $request->apellidoPaterno;
        $persona->apellidoMaterno = $request->apellidoMaterno;
        $persona->numero_documento = $request->numero_documento;
        $persona->direccion = $request->direccion;
        $persona->telefono = $request->telefono;
        $persona->fechaNacimiento = $request->fechaNacimiento;
        $persona->edad = $request->edad;
        $persona->genero = $request->genero;
        $persona->estadoCivil = $request->estadoCivil;
        $persona->user_id = $user->id;
        $persona->save();

        $empleado->tipoempleado_id = $request->tipoempleado;
        $empleado->save();


        return redirect()->route('Empleados.index');
    }
    public function eliminar($id)
    {
        $persona = Persona::findOrFail(Empleado::findOrFail($id)->persona->id);
        $persona->estado = "ANULADO";
        $persona->save();
        return redirect()->route('Empleados.index');
    }
}
