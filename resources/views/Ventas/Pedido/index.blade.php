@extends('Layout.index')
@section('contenido')
@section('ventas-active', 'active')
@section('PedidoMesa-active', 'active')
<div id="app">
    <pedido-component :usuario="{{ Auth::user() }}" :tiempoinicial="{{json_encode($tiempoInicial)}}"></pedido-component>
</div>
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js?v=' . rand()) }}"></script>
@endsection
@section('estilos')
@endsection
@section('script')

@endsection
