@extends('layout')

@section('title', 'Editar Espacio')

@section('contenido')
<div class="container">
    <h2>Editar Espacio</h2>
    <form action="{{ route('espacios.update', $espacio) }}" method="POST">
        @method('PUT')
        @include('espacios.partials.form', ['buttonText' => 'Actualizar'])
    </form>
</div>
@endsection
