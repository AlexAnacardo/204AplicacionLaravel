<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use App\Models\Tarea;

class AdminController extends Controller
{
    public function usuarios()
    {
        if (!auth()->check() || !auth()->user()->es_admin) {
            abort(403, 'Acceso no autorizado.');
        }

        $usuarios = User::paginate(10);

        return view('admin.usuarios', compact('usuarios'));
    }
    
    // Editar usuario
    public function editarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        return view('admin.editar_usuario', compact('usuario'));
    }

    public function actualizarUsuario(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update($request->only(['name', 'email', 'es_admin']));
        return redirect()->route('admin.usuarios')->with('success', 'Usuario actualizado');
    }

    public function eliminarUsuario($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->delete();
        return redirect()->route('admin.usuarios')->with('success', 'Usuario eliminado');
    }

    // Ver tareas del usuario
    public function verTareas($id)
    {
        $usuario = User::findOrFail($id);
        $tareas = $usuario->tareas()->paginate(10);
        return view('admin.tareas_usuario', compact('usuario', 'tareas'));
    }

    // Editar tarea
    public function editarTarea($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('admin.editar_tarea', compact('tarea'));
    }

    public function actualizarTarea(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->only(['titulo', 'descripcion', 'completada']));
        return redirect()->back()->with('success', 'Tarea actualizada');
    }

    public function eliminarTarea($id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->delete();
        return back()->with('success', 'Tarea eliminada');
    }
}
