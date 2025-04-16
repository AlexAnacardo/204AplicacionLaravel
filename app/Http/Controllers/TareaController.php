<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tarea;

class TareaController extends Controller
{
    public function index()
    {
        $tareas = Tarea::all();
        return view('tareas.index', compact('tareas'));
    }

    public function create()
    {
        return view('tareas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required',
            'descripcion' => 'nullable'
        ]);

        Tarea::create($request->all());
        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente.');
    }

    public function edit($id)
    {
        $tarea = Tarea::findOrFail($id);
        return view('tareas.edit', compact('tarea'));
    }

    public function update(Request $request, $id)
    {
        $tarea = Tarea::findOrFail($id);
        $tarea->update($request->all());
        return redirect()->route('tareas.index')->with('success', 'Tarea actualizada.');
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
