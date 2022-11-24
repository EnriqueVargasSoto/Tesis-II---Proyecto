@extends('Layout.index')
@section('contenido')
@section('reportes-active', 'active')
@section('ReporteProductos-active', 'active')
<div id="app">
    <reporteproducto-component></reporteproducto-component>
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
