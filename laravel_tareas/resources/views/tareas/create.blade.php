@extends('layouts.app')

@section('content')
<div class="form-box">
    <h2>Crear Nueva Tarea</h2>

    @if ($errors->any())
        <div class="error-alerta" style="background-color: #f8d7da; color: #721c24; padding: 10px; border-radius: 4px; margin-bottom: 1.5rem;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('tareas.store') }}">
        @csrf

        <div class="form-group">
            <label for="titulo">Título de la Tarea:</label>
            <input type="text" id="titulo" name="titulo" value="{{ old('titulo') }}" required placeholder="Ej. Redactar informe técnico">
        </div>

        <div class="form-group">
            <label for="descripcion">Descripción (Opcional):</label>
            <textarea id="descripcion" name="descripcion" rows="5" placeholder="Describe los detalles de la tarea...">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-botones">
            <button type="submit" class="btn-guardar">Guardar Tarea</button>
            <a href="{{ route('tareas.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>
@endsection