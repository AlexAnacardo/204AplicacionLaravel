<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Models\Tarea;

Route::get('/', function () {
    return view('welcome');
});
/*
Route::get('/dashboard', function () { 
    return view('tareas.index');
})->middleware(['auth', 'verified'])->name('dashboard');
*/
/*
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

use App\Http\Controllers\TareaController;

Route::middleware('auth')->group(function () {
    Route::get('/tareas', [TareaController::class, 'index'])->name('tareas.index');
    Route::get('/tareas/create', [TareaController::class, 'create'])->name('tareas.create');
    Route::post('/tareas', [TareaController::class, 'store'])->name('tareas.store');
    Route::get('/tareas/{id}/edit', [TareaController::class, 'edit'])->name('tareas.edit');
    Route::put('/tareas/{id}', [TareaController::class, 'update'])->name('tareas.update');
    Route::get('/tareas/{id}/delete', [TareaController::class, 'confirmDelete'])->name('tareas.confirmDelete');
    Route::delete('/tareas/{id}', [TareaController::class, 'destroy'])->name('tareas.destroy');
});


/*
Route::middleware('auth')->get('/tareas', function () {
    $tareas = Tarea::all();  // Obtener todas las tareas desde la base de datos
    return view('tareas.index', compact('tareas'));  // Pasar las tareas a la vista
})->name('tareas.index');


*/


Route::get('/dashboard', [TareaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__.'/auth.php';