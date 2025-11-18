@extends('layout')

@section('title', 'Lista de Reservas')

@section('contenido')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="mb-3">Lista de Reservas</h1>
    <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">Nueva Reserva</a>
</div>

<table class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Espacio</th>
      <th>Solicitante</th>
      <th>Fecha</th>
      <th>Hora Inicio</th>
      <th>Hora Fin</th>
      <th>Cantidad</th>
      <th>Motivo</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    @foreach($reservas as $reserva)
    <tr>
      <td>{{ $reserva->id }}</td>
      <td>{{ $reserva->espacio->nombre }}</td>
      <td>{{ $reserva->solicitante }}</td>
      <td>{{ $reserva->fecha }}</td>
      <td>{{ $reserva->hora_inicio }}</td>
      <td>{{ $reserva->hora_fin }}</td>
      <td>{{ $reserva->cantidad_personas }}</td>
      <td>{{ $reserva->motivo }}</td>
      <td>
        <a href="{{ route('reservas.edit', $reserva) }}" class="btn btn-success btn-sm">Editar</a>

        <form action="{{ route('reservas.destroy', $reserva->id) }}" 
              method="POST" 
              style="display:inline-block;"
              onsubmit="return confirm('¿Eliminar la reserva de {{ $reserva->solicitante }} en {{ $reserva->espacio->nombre }}?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
        </form>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

{{ $reservas->links() }}
@endsection
