@extends('Layout.index')
@section('contenido')
    <div id="app">
        <cajapertura-component></cajapertura-component>
    </div>
@endsection
@section('estilos-vue')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection
@section('script-vue')
<script src="{{ asset('js/app.js?v='.rand()) }}"></script>
@endsection
@section('estilos')
@endsection
@section('script')
@endsection
