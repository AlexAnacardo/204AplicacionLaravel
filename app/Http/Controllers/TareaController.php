<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        
        //Recupero el usuario de la sesion
        $usuarioEnCurso = session('usuarioEnCurso');
        
        $mostrarCompletadas = $request->query('completadas') === '1';
        
        
        $tareas = Tarea::where('user_id', $usuarioEnCurso->id)
                    ->where('completada', $mostrarCompletadas)
                    ->get();
        
        return view('tareas.index', compact('tareas', 'mostrarCompletadas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
        'titulo' => ['required', 'string', 'max:255', 'not_regex:/<script\b[^>]*>(.*?)<\/script>/i'],
        'descripcion' => ['nullable', 'string', 'max:1000', 'not_regex:/<script\b[^>]*>(.*?)<\/script>/i'],
        ]);        
        
        //Recupero el usuario de la sesion
        $usuarioEnCurso = session('usuarioEnCurso');
        
        //Tarea::create($request->only('titulo', 'descripcion'));
        
        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'user_id' => $usuarioEnCurso->id,  // Asociamos la tarea al usuario autenticado
        ]);
        
        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255', 'not_regex:/<script\b[^>]*>(.*?)<\/script>/i'],
            'descripcion' => ['nullable', 'string', 'max:1000', 'not_regex:/<script\b[^>]*>(.*?)<\/script>/i'],
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->only('titulo', 'descripcion'));

        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada.');
    }

    public function toggleEstado($id)
    {
        $tarea = Tarea::findOrFail($id);

        // Verificamos que la tarea sea del usuario en sesión
        $usuarioEnCurso = session('usuarioEnCurso');
        if ($tarea->user_id != $usuarioEnCurso->id) {
            abort(403, 'No autorizado.');
        }

        // Cambiamos el estado
        $tarea->completada = !$tarea->completada;
        $tarea->save();

        return redirect()->route('tareas.index');
    }

    
    public function destroy($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada.');
    }
    
    public function confirmDelete($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.confirm-delete', compact('tarea'));
    }

}
