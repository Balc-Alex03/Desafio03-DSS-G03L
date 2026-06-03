@extends('layouts.app')

@section('content')
<div class="form-box">
    <h2>Editar Tarea</h2>

    @if ($errors->any())
        <div class="error-alerta" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 1.5rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tareas.update', $tarea->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="titulo">Título de la Tarea:</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $tarea->titulo) }}" required>
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea id="descripcion" name="descripcion" rows="5">{{ old('descripcion', $tarea->descripcion) }}</textarea>
        </div>

        <div class="form-group">
            <label for="estado">Estado Actual:</label>
            <select id="estado" name="estado" required>
                <option value="pendiente" {{ old('estado', $tarea->estado) === 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en_progreso" {{ old('estado', $tarea->estado) === 'en_progreso' ? 'selected' : '' }}>En Progreso</option>
                <option value="completada" {{ old('estado', $tarea->estado) === 'completada' ? 'selected' : '' }}>Completada</option>
            </select>
        </div>

        <div class="form-botones">
            <button type="submit" class="btn-guardar">Actualizar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection