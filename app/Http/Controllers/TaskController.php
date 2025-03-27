<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    /**
     * Metodo index para obtener todas las tareas
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // metodo all() para traer todas las tareas
        return response()->json(Task::all(), Response::HTTP_OK);
    }

    /**
     * Metodo show para obtener una tarea por su ID
     * @param mixed $id ID de la tarea
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        // metodo find() para buscar una tarea por el id
        $task = Task::find($id);

        // retornar respuesta con la tarea o si no existe la tarea
        return $task
                ? response()->json($task, Response::HTTP_OK)
                : response()->json(['error' => 'No existe esta tarea'], Response::HTTP_NOT_FOUND);
    }

    /**
     * Metodo store para crear una tarea
     * @param \Illuminate\Http\Request $request
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // validar request (body, formulario)
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'in:Pendiente,En Proceso,Completada'
        ]);

        // registrar tarea
        $task = Task::create($validated);

        // retornar respuesra con la tarea nueva
        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Metodo update para actualizar una tarea por su ID
     * @param \Illuminate\Http\Request $request
     * @param mixed $id ID de la tarea
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return response()->json(['error' => 'No existe la tarea que quieres modificar'], Response::HTTP_NOT_FOUND);
        }

        // validar request (body, formulario)
        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes|nullable|string',
            'status' => 'sometimes|in:Pendiente,En Proceso,Completada'
        ]);

        // actualizar
        $task->update($validated);

        // retornar respuesta con la tarea actualiada
        return response()->json($task, Response::HTTP_OK);
    }

    /**
     * Metodo destroy para eliminar una tarea por su ID
     * @param mixed $id ID de la tarea
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        // buscar la tarea
        $task = Task::find($id);

        // no existe la tarea
        if (!$task) {
            return response()->json(['error' => 'No existe la tarea'], Response::HTTP_NOT_FOUND);
        }

        // eliminar
        $task->delete();

        // retornar mensaje
        return response()->json(['message' => 'Tarea eliminada'], Response::HTTP_OK);
    }
}
