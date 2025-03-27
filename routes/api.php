<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'index']); // Obtener todas las tareas
Route::get('/tasks/{id}', [TaskController::class, 'show']); // Obtener una tarea por su id
Route::post('/tasks', [TaskController::class, 'store']); // Crear una nueva tarea
Route::put('/tasks/{id}', [TaskController::class, 'update']); // Actualizar una tarea por su id
Route::delete('/tasks/{id}', [TaskController::class, 'destroy']); // Eliminar una tarea por su id
