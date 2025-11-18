@extends('layout')

@section('title', 'Crear Espacio')

@section('contenido')
<div class="container">
    <h2>Crear Nuevo Espacio</h2>
    <form action="{{ route('espacios.store') }}" method="POST">
        @include('espacios.partials.form', ['buttonText' => 'Crear'])
    </form>
</div>
@endsection
