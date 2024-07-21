<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shifts;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;
use App\Services\ShiftService;

class TaskController extends Controller
{
    protected $taskService;
    protected $shiftsService;

    public function __construct(TaskService $taskService, ShiftService $shiftService)
    {
        $this->taskService = $taskService;
        $this->shiftsService = $shiftService;
    }

    public function show($id)
    {
        $task   = $this->taskService->find($id);   
        $shifts = $this->shiftsService->findbytask($id);
        $user   = Auth::user();
        return view('tasks.show', compact('task','shifts', 'user'));
    }

    public function markTask(Request $request, $task_id, $user_id){
       dd($task_id);
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
}
