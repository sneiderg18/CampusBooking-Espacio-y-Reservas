@csrf

<div class="mb-3">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" 
           value="{{ old('nombre', $espacio->nombre ?? '') }}">
    @error('nombre')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tipo" class="form-label">Tipo</label>
    <input type="text" name="tipo" id="tipo" class="form-control @error('tipo') is-invalid @enderror" 
           value="{{ old('tipo', $espacio->tipo ?? '') }}">
    @error('tipo')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="capacidad" class="form-label">Capacidad</label>
    <input type="number" name="capacidad" id="capacidad" min="1" class="form-control @error('capacidad') is-invalid @enderror" 
           value="{{ old('capacidad', $espacio->capacidad ?? '') }}">
    @error('capacidad')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="ubicacion" class="form-label">Ubicación</label>
    <input type="text" name="ubicacion" id="ubicacion" class="form-control @error('ubicacion') is-invalid @enderror" 
           value="{{ old('ubicacion', $espacio->ubicacion ?? '') }}">
    @error('ubicacion')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<button type="submit" class="btn btn-success">{{ $buttonText }}</button>
<a href="{{ route('espacios.index') }}" class="btn btn-secondary">Cancelar</a>
