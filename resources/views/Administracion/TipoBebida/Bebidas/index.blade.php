@extends('Layout.index')
@section('contenido')
@section('abastecimiento-active', 'active')
@section('TipoBebida-active', 'active')

<div id="app">
    <input type="hidden" name="tipobebida_id" id="tipobebida_id" value="{{ $id }}">
    <bebida-list-component></bebida-list-component>
</div>
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">

@endsection

@section('script-vue')
<script src="{{ asset('js/app.js?v='.rand()) }}"></script>
@endsection
@section('estilos')
<link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
{{-- <link href="{{ asset('Inspinia/css/plugins/select2/select2.min.css') }}" rel="stylesheet"> --}}
@endsection
@section('script')
{{-- <script src="{{ asset('Inspinia/js/plugins/select2/select2.full.min.js') }}"></script> --}}
<script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script>
    $("#dataTables-insumo").DataTable({
        columnDefs: [{
            targets: [0],
            visible: false,
            searchable: false,
        }, {
            targets: [3],
            data: null,
            class: 'text-center',
            render: function(data, type, row) {
                return "<button type='button'  class='btn btn-danger btn-eliminar'><i class='fa fa-trash' aria-hidden='true'></i></button>"
            }
        }]
    })
    $("#dataTables-insumo_editar").DataTable({
        columnDefs: [{
            targets: [0],
            visible: false,
            searchable: false,
        }, {
            targets: [3],
            data: null,
            class: 'text-center',
            render: function(data, type, row) {
                return "<button type='button'  class='btn btn-danger btn-eliminar-editar'><i class='fa fa-trash' aria-hidden='true'></i></button>"
            }
        }]
    })
</script>
@endsection
