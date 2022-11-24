@extends('Layout.index')
@section('contenido')
@section('reportes-active', 'active')
@section('ReportePedidos-active', 'active')
<div id="app">
    <reportepedido-component :empleados="{{ $empleados }}" :tipopedidos="{{ $tipoPedidos }}"
        :tiempoinicial="{{ json_encode($tiempoInicial) }}"></reportepedido-component>
</div>
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js?v=' . rand()) }}"></script>
@endsection
@section('estilos')
<link href="{{ asset('Inspinia/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('script')
<script src="{{ asset('Inspinia/js/plugins/dataTables/datatables.min.js') }}"></script>
<script src="{{ asset('Inspinia/js/plugins/dataTables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('SweetAlert/sweetalert2@10.js') }}"></script>
<script>
    var tiempoInicial=new Date("{{$tiempoInicial}}")
    var ver=true;
</script>
<script src="{{ asset('js/Reportes/pedidoindex.js?v=' . rand()) }}">
</script>
@endsection
