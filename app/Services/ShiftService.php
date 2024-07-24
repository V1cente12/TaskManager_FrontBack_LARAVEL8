<?php

namespace App\Services;

use App\Models\Shifts;

class ShiftService
{
    //buscar registro por tarea
    public function findbytask($id)
    {
        return Shifts::where('task_id', $id)->with(['task', 'user', 'validator'])->get();
    }
    //busca todas los registros
    public function all()
    {
        return Shifts::all();
    }

    public function validateShiftbyId($user_id, $task_id, $shift_id){
        $task = Shifts::findOrFail($shift_id);
        $task->update([
            'validated_by' => $user_id,
            'validated_at' => now(),
        ]);
    }
    
    //crear registro
    public function createShift($user_id, $task_id)
    {
        return Shifts::create([
            'user_id' => $user_id,
            'task_id' => $task_id,
            'completed_at' => now(),
        ]);
    }

    public function create(array $data)
    {
        return Shifts::create($data);
    }

    public function update($id, array $data)
    {
        $task = Shifts::findOrFail($id);
        $task->update($data);
        return $task;
    }

    public function delete($id)
    {
        $task = Shifts::findOrFail($id);
        $task->delete();
        return $task;
    }
}
