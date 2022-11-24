@extends('Layout.index')
@section('contenido')
@section('facturar-active', 'active')
@section('PedidoFacturar-active', 'active')
<div class="container">
    <div id="app">
        <pedidofactura-component :tiempoinicial="{{json_encode($tiempoInicial)}}"></pedidofactura-component>
    </div>
</div>
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('SweetAlert/sweetalert2@10.js') }}"></script>
<script src="{{ asset('js/app.js?v='.rand()) }}"></script>
@endsection
@section('estilos')
@endsection
@section('script')

<script>

</script>
@endsection
