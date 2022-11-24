@extends('Layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('Clientes-active', 'active')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform:uppercase"><b>Crear Cliente</b></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('Clientes.index') }}">Clientes</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Crear Cliente</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <form class="wizard-big" action="{{ route('Clientes.store') }}" method="POST" id="form_registrar_cliente">
        @csrf
        <h1>Datos Del Cliente</h1>
        <fieldset style="position: relative;">
            <div class="row">
                <div class="col-md-6 b-r">
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-12">
                            <label class="required" id="">Tipo de Documento</label>
                            <select name="tipo_documento" id="tipo_documento"
                                class="form-control {{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}">
                                <option value="DNI">DNI</option>
                                <option value="RUC">RUC</option>
                            </select>
                            @if ($errors->has('tipo_documento'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('tipo_documento') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="required" id="">Documento</label>
                            <input type="text" id="documento" name="documento"
                                class="form-control {{ $errors->has('documento') ? ' is-invalid' : '' }}"
                                value="{{ old('documento') }}" maxlength="191">
                            @if ($errors->has('documento'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('documento') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label class="required" id="">Nombre</label>
                            <input type="text" id="nombre" name="nombre"
                                class="form-control {{ $errors->has('nombre') ? ' is-invalid' : '' }}"
                                value="{{ old('nombre') }}" maxlength="191" onkeyup="return mayus(this)">
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <label class="required" id="">Telefono</label>
                            <input type="text" id="telefono" name="telefono"
                                class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                value="{{ old('telefono') }}" maxlength="191" onkeyup="return mayus(this)">
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
                                value="{{ old('direccion') }}" maxlength="191" onkeyup="return mayus(this)">
                            @if ($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('direccion') }}</strong>
                                </span>
                            @endif
                        </div>

                    </div>
                    <div class="form-group row">
                        <div class="col-md-12 col-xs-12">
                            <label class="required" id="">Correo Electronico</label>
                            <input type="email" id="email" name="email"
                                class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                value="{{ old('email') }}" maxlength="191" onkeyup="return mayus(this)">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
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
<script src="{{ asset('js/Administracion/Clientes/create.js?v=' . rand()) }}"></script>
@endsection
