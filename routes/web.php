<?php

use App\Http\Controllers\TareaController;

Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
Route::get('/tareas/{id}/confirmar-eliminar', [TareaController::class, 'confirmDelete'])->name('tareas.confirmDelete');
