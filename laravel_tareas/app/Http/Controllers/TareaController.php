<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;

class TareaController extends Controller
{
    public function index()
    {
        $usuario_id = 1; 
        
        $usuario_id = session('usuario_id') ?? 1; 
    
        $tareas = Tarea::where('usuario_id', $usuario_id)->get();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'nullable'
        ]);

        $usuario_id = session('usuario_id') ?? 1;

        Tarea::create([
            'usuario_id' => $usuario_id, 
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'estado' => 'pendiente'
        ]);

        return redirect()->route('tareas.index')->with('exito', 'Tarea creada correctamente.');
    }

    public function show($id)
    {
        //no se necesita para el crud simple
    }

    public function edit($id)
    {
        $usuario_id = session('usuario_id') ?? 1;

        $tarea = Tarea::where('id', $id)->where('usuario_id', $usuario_id)->first();

        if (!$tarea) {
            abort(404, 'Tarea no encontrada o no autorizada.');
        }

    return view('tareas.edit', compact('tarea'));
}

    public function update(Request $request, $id)
    {
        $usuario_id = session('usuario_id') ?? 1; 
        $tarea = Tarea::where('id', $id)->where('usuario_id', $usuario_id)->first();

        if (!$tarea) {
            abort(404);
        }

        $request->validate([
            'titulo' => 'required|max:150',
            'descripcion' => 'nullable',
            'estado' => 'required|in:pendiente,en_progreso,completada'
        ]);

        $tarea->update([
            'titulo' => $request->input('titulo'),
            'descripcion' => $request->input('descripcion'),
            'estado' => $request->input('estado')
        ]);

        return redirect()->route('tareas.index')->with('exito', 'Tarea actualizada con éxito.');
    }

    public function destroy($id)
    {
        $usuario_id = session('usuario_id') ?? 1; 
        $tarea = Tarea::where('id', $id)->where('usuario_id', $usuario_id)->first();

        if ($tarea) {
            $tarea->delete();
        }

        return redirect()->route('tareas.index')->with('exito', 'Tarea eliminada de forma segura.');
    }

    public function actualizarEstado(Request $request, $id)
    {
        $usuario_id = session('usuario_id') ?? 1;
        
        $estados_validos = ['pendiente', 'en_progreso', 'completada'];
        $estado = $request->input('estado');
        
        if (!in_array($estado, $estados_validos)) {
            return response()->json(['exito' => false, 'mensaje' => 'Estado no válido']);
        }
        
        $tarea = Tarea::where('id', $id)->where('usuario_id', $usuario_id)->first();
        
        if (!$tarea) {
            return response()->json(['exito' => false, 'mensaje' => 'Tarea no encontrada']);
        }
        
        $tarea->update(['estado' => $estado]);
        
        return response()->json(['exito' => true]);
    }
}
?>