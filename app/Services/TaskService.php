<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    //buscar tarea por id
    public function find($id)
    {
        return Task::findOrFail($id);
    }
    //listar todas las tareas
    public function all()
    {
        return Task::all();
    }
    
    //crear tarea
    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update($id, array $data)
    {
        $task = Task::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return $task;
    }
}
