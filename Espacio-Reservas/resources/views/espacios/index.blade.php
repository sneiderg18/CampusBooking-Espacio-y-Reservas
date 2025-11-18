@extends('layout')

@section('title', 'Lista de Espacios')

@section('contenido')
<style>
    
</style>
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Espacios</h2>
    <a href="{{ route('espacios.create') }}" class="btn btn-primary">Nuevo Espacio</a>
</div>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th><th>Nombre</th><th>Tipo</th><th>Capacidad</th><th>Ubicación</th><th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($espacios as $e)
        <tr>
            <td>{{ $e->id }}</td>
            <td>{{ $e->nombre }}</td>
            <td>{{ $e->tipo }}</td>
            <td>{{ $e->capacidad }}</td>
            <td>{{ $e->ubicacion }}</td>
            <td>
                <a href="{{ route('espacios.edit', $e) }}" class="btn btn-success btn-sm">Editar</a>
                <form action="{{ route('espacios.destroy', $e) }}" method="POST" class="d-inline">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar este espacio {{ $e->nombre }}?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $espacios->links() }}
@endsection
