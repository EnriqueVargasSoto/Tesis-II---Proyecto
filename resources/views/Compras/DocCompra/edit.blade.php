@extends('Layout.index')
@section('contenido')
@section('compras-active', 'active')
@section('DocCompra-active', 'active')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10">
        <h2 style="text-transform:uppercase"><b>Editar Doc Compra</b></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('DocCompra.index') }}">Doc Compra</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Editar Doc Compra</strong>
            </li>
        </ol>
    </div>
</div>
<div class="wrapper wrapper-content animated fadeIn">
    <div class="card">
        <div class="card-body">
            <form action="{{ route('DocCompra.editar', $docCompra->id) }}" method="post" id="frm_edit">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6 b-r">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Proveedores</label>
                                <select name="Proveedor" id="Proveedor" class="select2_form form-control">
                                    <option value=""></option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}"
                                            {{ $docCompra->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                                            {{ $proveedor->nombre_comercial }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Destino</label>
                                <select name="Deposito" id="Deposito" class="select2_form form-control">
                                    <option value=""></option>
                                    @foreach ($depositos as $deposito)
                                        <option value="{{ $deposito->id }}"
                                            {{ $docCompra->deposito_id == $deposito->id ? 'selected' : '' }}>
                                            {{ $deposito->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Fecha Emision</label>
                                <input type="date" name="fecha_emision" id="fecha_emision" class="form-control"
                                    value={{ $docCompra->fecha_emision }}>
                            </div>
                            <div class="col-md-6">
                                <label for="">Fecha Entrega</label>
                                <input type="date" name="fecha_entrega" id="fecha_entrega" class="form-control"
                                    value={{ $docCompra->fecha_entrega }}>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Igv %</label>
                                <div class="input-group m-b">
                                    <div class="input-group-prepend">
                                        <span class="input-group-addon">
                                            <input type="checkbox" id="igv" name="igv" {{$docCompra->igv=="Si"?'checked':''}} >
                                        </span>
                                    </div>
                                    <input type="number" id="cantidad_igv" name="cantidad_igv" class="form-control"
                                    {{$docCompra->igv=="No"?'readonly':''}}
                                        value="{{ $docCompra->cantidad_igv == 0 ? '' : $docCompra->cantidad_igv }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Modo Compra</label>
                                <select name="modo_compra" id="modo_compra" class="form-control">
                                    <option value="CONTADO" {{ $docCompra->modo_compra == 'CONTADO' ? 'selected' : '' }}>
                                        CONTADO</option>
                                    <option value="CREDITO" {{ $docCompra->modo_compra == 'CREDITO' ? 'selected' : '' }}>
                                        CREDITO</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Tipo Moneda</label>
                                <select name="tipo_moneda" id="tipo_moneda" class="form-control">
                                    <option value="SOLES" {{ $docCompra->tipo_moneda == 'SOLES' ? 'selected' : '' }}>
                                        Soles</option>
                                    <option value="DOLARES" {{ $docCompra->tipo_moneda == 'DOLARES' ? 'selected' : '' }}>
                                        Dolares</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Imagen:</label>
                                <div class="custom-file">
                                    <input id="logo" type="file" name="logo" onchange="seleccionarimagen()"
                                        class="custom-file-input" accept="image/*" src='{{Storage::url($docCompra->ruta_imagen)}}'>
                                    <label for="logo" id="logo_txt" name="logo_txt"
                                        class="custom-file-label selected {{ $errors->has('ruta') ? ' is-invalid' : '' }}">{{$docCompra->nombre_imagen}}</label>
                                    @if ($errors->has('logo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
                                    <div class="invalid-feedback"><b><span id="error-logo_mensaje"></span></b></div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-7">
                                <div class="row  justify-content-end">
                                    <a href="javascript:void(0);" id="limpiar_logo" onclick="limpiar()">
                                        <span class="badge badge-danger">x</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-lg-2">
                            </div>
                            <div class="col-lg-7">
                                <p>
                                    <img class="logo img-fluid" src="{{Storage::url($docCompra->ruta_imagen)}}" alt="">
                                    <input id="url_logo" name="url_logo" type="hidden"
                                        value="{{$docCompra->ruta_imagen}}">
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class=""><b>DETALLE DE DOCUMENTO DE COMPRA</b></h4>
                            </div>
                            <div class="panel-body">


                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="">Insumos</label>
                                        <select name="insumo" id="insumo" class="select2_form form-control">
                                            <option value=""></option>
                                            @foreach ($insumos as $insumo)
                                                <option data-id="{{ $insumo->id }}"
                                                    data-precio="{{ $insumo->precio }}"
                                                    data-nombre="{{ $insumo->nombre }}" value="{{ $insumo->id }}">
                                                    {{ $insumo->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Precio</label>
                                        <input type="number" name="precio" id="precio" class="form-control" step="any">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control">
                                    </div>
                                    <div class="col-md-3" style="padding-top:28px;">
                                        <button class="btn btn-agregar btn-primary btn-block"
                                            id="pablo">Agregar</button>
                                    </div>
                                </div>
                                <hr>

                                <div class="table-responsive">
                                    <table
                                        class="table dataTables-orden-detalle table-striped table-bordered table-hover"
                                        style="text-transform:uppercase">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th class="text-center">ACCIONES</th>
                                                <th class="text-center">INSUMO</th>
                                                <th class="text-center">PRECIO</th>
                                                <th class="text-center">CANTIDAD</th>
                                                <th class="text-center">TOTAL</th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" style="text-align:right">Sub Total:</th>
                                                <th class="text-center"><span id="subtotal">0.0</span></th>
                                            </tr>
                                            <tr>
                                                <th colspan="5" class="text-center">IGV <span id="igv_int"></span>:</th>
                                                <th class="text-center"><span id="igv_monto">0.0</span></th>

                                            </tr>
                                            <tr>
                                                <th colspan="5" class="text-center">TOTAL:</th>
                                                <th class="text-center"><span id="total">0.0</span></th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="arreglo_insumo" id="arreglo_insumo">
                <div class="row">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <button class="btn btn-primary btn-block" type="button" id="guardar_store">Guardar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
<input type="hidden" name="arregloDetalle" id="arregloDetalle"  value="{{$arreglodetalle}}">
@include('Compras.DocCompra.modaledit')
@include('Compras.DocCompra.modalimg')
@endsection
@section('estilos')
<link href="{{ asset('Inspinia/css/plugins/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ asset('Inspinia/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
<link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('script')
<script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/select2/select2.full.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/steps/jquery.steps.min.js') }}"></script>
<script src="{{ asset('js/Compras/DocCompra/edit.js?v='.rand()) }}"></script>
@endsection
