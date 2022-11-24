@extends('Layout.index')
@section('mantenimiento-active','active')
@section('Numeracion-active','active')
@section('contenido')
    <div id="app">
        <numeracionindex-component></numeracionindex-component>
    </div>
@endsection
@section('estilos-vue')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
