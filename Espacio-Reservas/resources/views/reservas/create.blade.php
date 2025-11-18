@extends('layout')

@section('title', 'Crear Reserva')

@section('contenido')
<h1>Nueva Reserva</h1>

<form action="{{ route('reservas.store') }}" method="POST">
    @csrf

    {{-- Espacio --}}
    <div class="mb-3">
        <label for="espacio_id" class="form-label">Espacio:</label>
        <select name="espacio_id" id="espacio_id" 
                class="form-control @error('espacio_id') is-invalid @enderror">
            <option value="">Seleccione un espacio</option>
            @foreach($espacios as $espacio)
                <option value="{{ $espacio->id }}"
                    {{ old('espacio_id') == $espacio->id ? 'selected' : '' }}>
                    {{ $espacio->nombre }}
                </option>
            @endforeach
        </select>
        @error('espacio_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Solicitante --}}
    <div class="mb-3">
        <label for="solicitante" class="form-label">Solicitante:</label>
        <input type="text" name="solicitante" id="solicitante"
               class="form-control @error('solicitante') is-invalid @enderror"
               value="{{ old('solicitante') }}">
        @error('solicitante')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Fecha --}}
    <div class="mb-3">
        <label for="fecha" class="form-label">Fecha:</label>
        <input type="date" name="fecha" id="fecha"
               class="form-control @error('fecha') is-invalid @enderror"
               value="{{ old('fecha') }}">
        @error('fecha')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label>Cantidad de Personas:</label>
        <input type="number" name="cantidad_personas" min="1" class="form-control @error('cantidad_personas') is-invalid @enderror"
            value="{{ old('cantidad_personas') }}" required>
        @error('cantidad_personas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>


    {{-- Hora Inicio --}}
    <div class="mb-3">
        <label for="hora_inicio" class="form-label">Hora Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio"
               class="form-control @error('hora_inicio') is-invalid @enderror"
               value="{{ old('hora_inicio') }}">
        @error('hora_inicio')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Hora Fin --}}
    <div class="mb-3">
        <label for="hora_fin" class="form-label">Hora Fin:</label>
        <input type="time" name="hora_fin" id="hora_fin"
               class="form-control @error('hora_fin') is-invalid @enderror"
               value="{{ old('hora_fin') }}">
        @error('hora_fin')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Motivo --}}
    <div class="mb-3">
        <label for="motivo" class="form-label">Motivo:</label>
        <input type="text" name="motivo" id="motivo"
               class="form-control @error('motivo') is-invalid @enderror"
               value="{{ old('motivo') }}">
        @error('motivo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-success">Guardar Reserva</button>
    <a href="{{ route('reservas.index') }}" class="btn btn-secondary">Cancelar</a>

</form>
@endsection
