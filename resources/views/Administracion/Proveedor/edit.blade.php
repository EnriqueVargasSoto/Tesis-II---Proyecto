@extends('Layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('Proveedores-active', 'active')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform:uppercase"><b>Editar Proveedor</b></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('Proveedor.index') }}">Proveedor</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Editar Proveedor</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <form class="wizard-big" action="{{ route('Proveedor.editar', $id) }}" method="POST"
        id="form_editar_proveedor">
        @csrf
        @method('PUT')
        <h1>Datos De Proveedor</h1>
        <fieldset style="position: relative;">
            <div class="row">
                <div class="col-md-6 b-r">
                    <div class="form-group row">
                        <div class="col-md-6 col-xs-12">
                            <label class="required" id="">Telefono</label>
                            <input type="text" id="telefono" name="telefono"
                                class="form-control {{ $errors->has('telefono') ? ' is-invalid' : '' }}"
                                value="{{ old('telefono', $proveedor->telefono) }}" maxlength="191">
                            @if ($errors->has('telefono'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telefono') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <label class="required" id="">Numero Documento</label>
                            <input type="text" id="numero_documento" name="numero_documento"
                                class="form-control {{ $errors->has('numero_documento') ? ' is-invalid' : '' }}"
                                value="{{ old('numero_documento', $proveedor->numero_documento) }}" maxlength="191">
                            @if ($errors->has('numero_documento'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('numero_documento') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-12 col-xs-12">
                            <label class="required" id="">Nombre Comercial</label>
                            <input type="text" id="nombre_comercial" name="nombre_comercial"
                                class="form-control {{ $errors->has('nombre_comercial') ? ' is-invalid' : '' }}"
                                value="{{ old('nombre_comercial', $proveedor->nombre_comercial) }}" maxlength="191">
                            @if ($errors->has('nombre_comercial'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre_comercial') }}</strong>
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
                                value="{{ old('direccion', $proveedor->direccion) }}" maxlength="191">
                            @if ($errors->has('direccion'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('direccion') }}</strong>
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
<script src="{{ asset('js/Administracion/Proveedor/edit.js?v=' . rand()) }}"></script>
@endsection
