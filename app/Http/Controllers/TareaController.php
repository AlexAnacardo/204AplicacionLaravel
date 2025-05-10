<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index(Request $request)
    {
        $usuario = session('usuarioEnCurso');
        $completadas = $request->boolean('completadas');

        // Validar filtros
        $validated = $request->validate([
            'buscar' => ['nullable', 'string', 'max:100'],
            'prioridad' => ['nullable', 'in:baja,media,alta'],
        ]);

        // Construir consulta base
        $query = Tarea::where('user_id', $usuario->id)
                      ->where('completada', $completadas);

        // Filtro por texto
        if (!empty($validated['buscar'])) {
            $query->where(function ($q) use ($validated) {
                $q->where('titulo', 'like', '%' . $validated['buscar'] . '%')
                  ->orWhere('descripcion', 'like', '%' . $validated['buscar'] . '%');
            });
        }

        // Filtro por prioridad
        if (!empty($validated['prioridad'])) {
            $query->where('prioridad', $validated['prioridad']);
        }

        // Obtener resultados paginados
        $tareas = $query->latest()->paginate(6)->withQueryString();

        return view('tareas.index', compact('tareas'))->with('mostrarCompletadas', $completadas);

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
        'prioridad' => ['required', 'in:baja,media,alta'],
        ]);        
        
        //Recupero el usuario de la sesion
        $usuarioEnCurso = session('usuarioEnCurso');
        
        //Tarea::create($request->only('titulo', 'descripcion'));
        
        Tarea::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'user_id' => $usuarioEnCurso->id,  // Asociamos la tarea al usuario autenticado
            'prioridad' => $request->prioridad,
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
            'prioridad' => ['required', 'in:baja,media,alta'],
        ]);

        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->only('titulo', 'descripcion', 'prioridad'));

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
