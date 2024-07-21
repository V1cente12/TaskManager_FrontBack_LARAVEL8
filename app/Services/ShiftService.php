<?php

namespace App\Services;

use App\Models\Shifts;

class ShiftService
{
    public function find($id)
    {
        return Shifts::findOrFail($id);
    }

    public function all()
    {
        return Shifts::all();
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
