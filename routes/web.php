<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Models\Tarea;

Route::get('/', function () {
    return view('welcome');
});


use App\Http\Controllers\TareaController;

Route::middleware('auth')->group(function () {
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
    Route::get('/tareas/{id}/delete', [TareaController::class, 'confirmDelete'])->name('tareas.confirmDelete');
    Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    Route::get('/tareas/{id}/toggle', [TareaController::class, 'toggleEstado'])->name('tareas.toggleEstado');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
});

Route::prefix('admin/usuarios')->middleware('auth')->group(function () {
    Route::get('{id}/editar', [AdminController::class, 'editarUsuario'])->name('admin.usuarios.editar');
    Route::put('{id}', [AdminController::class, 'actualizarUsuario'])->name('admin.usuarios.actualizar');
    Route::delete('{id}', [AdminController::class, 'eliminarUsuario'])->name('admin.usuarios.eliminar');
    Route::get('{id}/tareas', [AdminController::class, 'verTareas'])->name('admin.usuarios.tareas');
    
    // Acciones sobre tareas desde admin
    Route::get('tareas/{id}/editar', [AdminController::class, 'editarTarea'])->name('admin.tareas.editar');
    Route::put('tareas/{id}', [AdminController::class, 'actualizarTarea'])->name('admin.tareas.actualizar');
    Route::delete('tareas/{id}', [AdminController::class, 'eliminarTarea'])->name('admin.tareas.eliminar');
});


Route::get('/dashboard', [TareaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';