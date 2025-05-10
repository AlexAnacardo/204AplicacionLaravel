<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
       
        $usuarios = User::paginate(10);
        return view('admin.usuarios', compact('usuarios'));
    }

    public function edit(User $usuario)
    {
        return view('admin.editar_usuario', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        // Validación y actualización del usuario
        $usuario->update($request->all());
        return redirect()->route('admin.usuarios');
    }

    public function destroy(User $usuario)
    {
        // Elimina un usuario
        $usuario->delete();
        return redirect()->route('admin.usuarios');
    }
}
