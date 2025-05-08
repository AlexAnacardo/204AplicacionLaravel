<?php

use App\Http\Controllers\ProfileController;
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

});

Route::get('/dashboard', [TareaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';