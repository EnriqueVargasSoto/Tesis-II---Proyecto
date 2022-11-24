@extends('Layout.index')
@section('contenido')
@section('facturar-active', 'active')
@section('documentoVenta-active', 'active')
<div id="app">
    <documentoventaindex-component :error="{{ json_encode(session('error')) }}"
        :clientes="{{ json_encode(getClientes()) }}" :clientesruc="{{ json_encode(getClientesRuc()) }}"
        :csrf="{{ json_encode(csrf_token()) }}">
    </documentoventaindex-component>
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
<script src="{{ asset('SweetAlert/sweetalert2@10.js') }}"></script>
@endsection
