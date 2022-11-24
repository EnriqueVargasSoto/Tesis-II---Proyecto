@extends('Layout.index')
@section('contenido')
@section('reportes-active', 'active')
@section('ReporteVentas-active', 'active')
<div id="app">
    <reporteventa-component :tipopedidos="{{ $tipoPedidos }}"></reporteventa-component>
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
