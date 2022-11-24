@extends('Layout.index')
@section('contenido')
@section('administracion-active', 'active')
@section('Proveedores-active', 'active')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10 col-md-10">
            <h2 style="text-transform:uppercase"><b>Listado de Proveedores</b></h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('Inicio') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Proveedores</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2 col-md-2">
            <button id="btn_añadir_proveedor" class="btn btn-block btn-w-m btn-primary m-t-md">
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
                            <table class="table dataTables-proveedor table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nombre Comercial</th>
                                        <th class="text-center">Numero Documento</th>
                                        <th class="text-center">Telefono</th>
                                        <th class="text-center">Direccion</th>
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
@endsection
@section('estilos')
    <link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('script')
    <script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('SweetAlert/sweetalert2@10.js') }}">
    </script>
    <script src="{{ asset('js/Administracion/Proveedor/index.js?v='.rand()) }}">
    </script>
@endsection
