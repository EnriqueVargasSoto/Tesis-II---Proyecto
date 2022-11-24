@extends('Layout.index')
@section('contenido')
@section('abastecimiento-active', 'active')
@section('TipoMesa-active', 'active')

    <div id="app">
        <input type="hidden" name="tipomesa_id" id="tipomesa_id" value="{{$id}}">
        <mesa-list-component></mesa-list-component>
    </div>
    {{-- <div class="wrapper wrapper-content animated fadeInRight">
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
    @include('Administracion.TipoMesa.modaledit') --}}
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('script-vue')
<script src="{{asset('js/app.js')}}"></script>
    {{-- <script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/Administracion/TipoMesa/index.js?v='.rand()) }}">
    </script> --}}
@endsection

