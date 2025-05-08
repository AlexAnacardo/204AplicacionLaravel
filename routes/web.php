<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\TareaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

use App\Models\Tarea;

Route::get('/', function () {
    return view('welcome');
});

// Rutas de tareas
Route::middleware('auth')->group(function () {
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
    Route::get('/tareas/{id}/delete', [TareaController::class, 'confirmDelete'])->name('tareas.confirmDelete');
    Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
    Route::get('/tareas/{id}/toggle', [TareaController::class, 'toggleEstado'])->name('tareas.toggleEstado');
});

// Rutas de administración para usuarios
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function() {
    // Rutas para usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios');
    Route::get('/usuarios/{usuario}/editar', [UserController::class, 'edit'])->name('usuarios.editar');
    Route::put('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.actualizar');
    Route::delete('/usuarios/{usuario}', [UserController::class, 'destroy'])->name('usuarios.eliminar');

    // Rutas para tareas
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas');
    Route::get('/tareas/{tarea}/editar', [TareaController::class, 'edit'])->name('tareas.editar');
    Route::put('/tareas/{tarea}', [TareaController::class, 'update'])->name('tareas.actualizar');
    Route::delete('/tareas/{tarea}', [TareaController::class, 'destroy'])->name('tareas.eliminar');
});

Route::get('/admin/usuarios/{usuario}/tareas', [AdminController::class, 'verTareas'])->name('admin.usuarios.tareas');

Route::get('/dashboard', [TareaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
