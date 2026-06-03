@extends('layouts.app')

@section('content')
<div class="dashboard-header">
    <h2>Mis Tareas (Laravel)</h2>
    <a href="{{ route('tareas.create') }}" class="btn-nueva">+ Nueva Tarea</a>
</div>

@if(session('exito'))
    <div class="exito-alerta" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 4px; margin-bottom: 1.5rem;">
        {{ session('exito') }}
    </div>
@endif

@if($tareas->isEmpty())
    <div class="sin-tareas">
        <p>No tienes tareas aún. ¡Comienza creando una nueva!</p>
    </div>
@else
    <div class="listado-tareas">
        @foreach ($tareas as $tarea)
            <div class="tarea-card">
                <div class="tarea-contenido">
                    <h3>{{ $tarea->titulo }}</h3>
                    <p>{!! nl2br(e($tarea->descripcion)) !!}</p>
                    
                    <div class="btns-estado" data-id="{{ $tarea->id }}">
                        <button class="btn-estado {{ $tarea->estado === 'pendiente' ? 'activo' : '' }}" data-estado="pendiente">Pendiente</button>
                        <button class="btn-estado {{ $tarea->estado === 'en_progreso' ? 'activo' : '' }}" data-estado="en_progreso">En Progreso</button>
                        <button class="btn-estado {{ $tarea->estado === 'completada' ? 'activo' : '' }}" data-estado="completada">Completada</button>
                    </div>
                </div>
                
                <div class="tarea-acciones">
                    <a href="{{ route('tareas.edit', $tarea->id) }}" class="btn-editar">Editar</a>
                    
                    <form method="POST" action="{{ route('tareas.destroy', $tarea->id) }}" class="form-eliminar" onsubmit="return confirm('¿Estás seguro de eliminar esta tarea?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-eliminar">Eliminar</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
@endif
@endsection