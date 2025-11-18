@extends('layout')

@section('title', 'Editar Reserva')

@section('contenido')
<h1 class="mb-4">Editar Reserva</h1>

<form action="{{ route('reservas.update', $reserva->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="espacio_id" class="form-label">Espacio</label>
        <select name="espacio_id" class="form-control">
            @foreach($espacios as $espacio)
                <option value="{{ $espacio->id }}" 
                    {{ $reserva->espacio_id == $espacio->id ? 'selected' : '' }}>
                    {{ $espacio->nombre }} (Cap: {{ $espacio->capacidad }})
                </option>
            @endforeach
        </select>
        @error('espacio_id') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="solicitante" class="form-label">Solicitante</label>
        <input type="text" name="solicitante" class="form-control" value="{{ old('solicitante', $reserva->solicitante) }}">
        @error('solicitante') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control" value="{{ old('fecha', $reserva->fecha) }}">
        @error('fecha') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora Inicio</label>
        <input type="time" name="hora_inicio" class="form-control" value="{{ old('hora_inicio', $reserva->hora_inicio) }}">
        @error('hora_inicio') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora Fin</label>
        <input type="time" name="hora_fin" class="form-control" value="{{ old('hora_fin', $reserva->hora_fin) }}">
        @error('hora_fin') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="cantidad_personas" class="form-label">Cantidad de Personas</label>
        <input type="number" min="1" name="cantidad_personas" 
               class="form-control"
               value="{{ old('cantidad_personas', $reserva->cantidad_personas) }}">
        @error('cantidad_personas') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="motivo" class="form-label">Motivo</label>
        <input type="text" name="motivo" class="form-control" value="{{ old('motivo', $reserva->motivo) }}">
        @error('motivo') <div class="text-danger">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
