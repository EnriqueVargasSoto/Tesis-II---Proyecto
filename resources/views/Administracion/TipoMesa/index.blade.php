@extends('Layout.index')
@section('contenido')
@section('abastecimiento-active', 'active')
@section('TipoMesa-active', 'active')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-10">
            <h2 style="text-transform:uppercase"><b>Listado de Tipos de Mesas</b></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Inicio') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Tipos de Mesa</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2 col-md-2">
            <button id="btn_añadir_tipoMesa" class="btn btn-block btn-w-m btn-primary m-t-md">
                <i class="fa fa-plus-square"></i> Añadir nuevo
            </button>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <div class="table-responsive">
                            <table class="table dataTables-tipoMesa table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Tipo</th>
                                        <th class="text-center">N°-Personas</th>
                                        <th class="text-center">Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('Administracion.TipoMesa.modalcreate')
    @include('Administracion.TipoMesa.modaledit')
@endsection
@section('estilos')
    <link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('script')
    <script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Administracion/TipoMesa/index.js?v='.rand()) }}">

    </script>
@endsection
