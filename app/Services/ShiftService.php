<?php

namespace App\Services;

use App\Models\Shifts;

class ShiftService
{
    public function findbytask($id)
    {
        return Shifts::where('task_id', $id)->with(['task', 'user'])->get();
    }

    public function all()
    {
        return Shifts::all();
    }
    
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
