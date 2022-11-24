@extends('Layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('Empleados-active', 'active')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-10">
            <h2 style="text-transform:uppercase"><b>Crear Empleado</b></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Empleados.index') }}">Empleados</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Crear Empleado</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeIn">
        <form class="wizard-big" action="{{ route('Empleados.store') }}" method="POST" id="form_registrar_empleado">
            @csrf
            <h1>Datos De Empleado</h1>
            <fieldset style="position: relative;">
                <div class="row">
                    <div class="col-md-6 b-r">
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Nombre</label>
                                <input type="text" id="nombre" name="nombre"
                                    class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                    value="{{ old('nombre') }}"
                                    maxlength="191" >
                                @if ($errors->has('nombre'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombre') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Numero de Documento(Dni/Ruc)</label>
                                <input type="text" id="numero_documento" name="numero_documento"
                                    class="form-control {{ $errors->has('numero_documento') ? ' is-invalid' : '' }}"
                                    value="{{ old('numero_documento') }}"
                                    maxlength="191" >
                                @if ($errors->has('numero_documento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('numero_documento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Apellido Paterno</label>
                                <input type="text" id="apellidoPaterno" name="apellidoPaterno"
                                    class="form-control {{ $errors->has('apellidoPaterno') ? ' is-invalid' : '' }}"
                                    value="{{ old('apellidoPaterno') }}"
                                    maxlength="191" >
                                @if ($errors->has('apellidoPaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidoPaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Apellido Materno</label>
                                <input type="text" id="apellidoMaterno" name="apellidoMaterno"
                                    class="form-control {{ $errors->has('apellidoMaterno') ? ' is-invalid' : '' }}"
                                    value="{{ old('apellidoMaterno') }}"
                                    maxlength="191" >
                                @if ($errors->has('apellidoMaterno'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('apellidoMaterno') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Telefono</label>
                                <input type="text" id="telefono" name="telefono"
                                    class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                    value="{{ old('telefono') }}"
                                    maxlength="191" >
                                @if ($errors->has('telefono'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telefono') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label class="required" id="">Direccion</label>
                                <input type="text" id="direccion" name="direccion"
                                    class="form-control {{ $errors->has('direccion') ? ' is-invalid' : '' }}"
                                    value="{{ old('direccion') }}"
                                    maxlength="191" >
                                @if ($errors->has('direccion'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('direccion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Fecha Nacimiento</label>
                                <input type="date" id="fechaNacimiento" name="fechaNacimiento"
                                    class="form-control {{ $errors->has('fechaNacimiento') ? ' is-invalid' : '' }}"
                                    value="{{ old('fechaNacimiento') }}"
                                    maxlength="191" >
                                @if ($errors->has('fechaNacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fechaNacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Edad</label>
                                <input type="text" id="edad" name="edad"
                                    class="form-control {{ $errors->has('edad') ? ' is-invalid' : '' }}"
                                    value="{{ old('edad') }}"
                                    maxlength="2" >
                                @if ($errors->has('edad'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('edad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Genero</label>
                                {{-- <input type="text" id="genero" name="genero"
                                    class="form-control {{ $errors->has('genero') ? ' is-invalid' : '' }}"
                                    value="{{ old('genero') }}"
                                    maxlength="191" > --}}
                                <select name="genero" id="genero" class="form-control {{ $errors->has('genero') ? ' is-invalid' : '' }}">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                                @if ($errors->has('genero'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('genero') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Estado Civil</label>
                                <select name="estadoCivil" id="estadoCivil" class="form-control {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}">
                                    <option value="Casado">Casada(o)</option>
                                    <option value="Viudo">Viuda(o)</option>
                                    <option value="Soltero">Soltera(o)</option>
                                </select>
                                {{-- <input type="text" id="estadoCivil" name="estadoCivil"
                                    class="form-control {{ $errors->has('estadoCivil') ? ' is-invalid' : '' }}"
                                    value="{{ old('estadoCivil') }}"
                                    maxlength="191" > --}}
                                @if ($errors->has('estadoCivil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estadoCivil') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="m-t-md col-lg-8">
                        <i class="fa fa-exclamation-circle leyenda-required"></i> <small class="leyenda-required">Los campos
                            marcados con asterisco (*) son obligatorios.</small>
                    </div>
                </div>
            </fieldset>
            <h1>Datos Del Usuario</h1>
            <fieldset style="position: relative;">
                <div class="row">
                    <div class="col-md-6 b-r">
                        <div class="form-group row">
                            <div class="col-md-12 col-xs-12">
                                <label class="required" id="">Email</label>
                                <input type="text" id="email" name="email"
                                    class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    value="{{ old('email') }}"
                                    maxlength="191" >
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Contraseña</label>
                                <input type="password" id="password" name="password"
                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    value="{{ old('password') }}"
                                    maxlength="191" >
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Confirmar Contraseña</label>
                                <input type="password" id="confirmpassword" name="confirmpassword"
                                    class="form-control {{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}"
                                    value="{{ old('confirmpassword') }}"
                                    maxlength="191" >
                                @if ($errors->has('confirmpassword'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('confirmpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 col-xs-12">
                                <label class="required" id="">Tipo Empleado</label>
                                <select name="tipoempleado" id="tipoempleado" value="{{ old('tipoempleado') }}" class="form-control {{$errors->has('tipoempleado') ? ' is-invalid' : ''}}">
                                @foreach (tipos_empleado() as $tipo)
                                    <option value="{{$tipo->id}}">{{$tipo->tipo}}</option>
                                @endforeach
                                </select>

                                {{-- <input type="password" id="password" name="password"
                                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    value="{{ old('password') }}"
                                    maxlength="191" > --}}
                                @if ($errors->has('tipoempleado'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('tipoempleado') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="m-t-md col-lg-8">
                        <i class="fa fa-exclamation-circle leyenda-required"></i> <small class="leyenda-required">Los campos
                            marcados con asterisco (*) son obligatorios.</small>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
@endsection
@section('estilos')
<link href="{{ asset('Inspinia/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('Inspinia/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
@endsection
@section('script')
<script src="{{ asset('Inspinia/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/steps/jquery.steps.min.js') }}"></script>
<script src="{{asset('js/Administracion/Empleado/create.js?v='.rand()) }}"></script>
@endsection
