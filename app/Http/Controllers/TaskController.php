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

    public function __construct(TaskService $taskService, ShiftService $shiftService){
        $this->taskService = $taskService;
        $this->shiftsService = $shiftService;
    }

    public function show($id){
        $task   = $this->taskService->find($id);   
        $shifts = $this->shiftsService->findbytask($id);
        $user   = Auth::user();
        return view('tasks.show', compact('task','shifts', 'user'));
    }

    public function markTask(Request $request, $task_id, $user_id){
        $this->shiftsService->createShift($user_id, $task_id);
        return redirect()->back()->with('status', 'Tarea marcada como realizada.');
    }
}
