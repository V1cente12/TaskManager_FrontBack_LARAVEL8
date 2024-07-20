<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shifts;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function markTask(Request $request){
       
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
        ]);

        $shift = new Shifts();
        $shift->user_id = Auth::id();
        $shift->task_id = $request->task_id;
        $shift->completed_at = now();
        $shift->save();

        return redirect()->back()->with('status', 'Tarea marcada como realizada.');
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.show', compact('task'));
    }
    
}
