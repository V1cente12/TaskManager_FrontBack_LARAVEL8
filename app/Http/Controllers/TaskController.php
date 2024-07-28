<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shifts;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;
use App\Services\ShiftService;
use App\Services\RoleService;

class TaskController extends Controller
{
    protected $taskService;
    protected $shiftsService;
    protected $roleService;

    public function __construct(TaskService $taskService, ShiftService $shiftService, RoleService $rolService){
        $this->taskService = $taskService;
        $this->shiftsService = $shiftService;
        $this->roleService = $rolService;
    }
    
    //mostrar tareas
    public function show($id){
        $user   = Auth::user();
        $task   = $this->taskService->find($id);   
        $shifts = $this->shiftsService->findbytask($id);
        return view('tasks.show', compact('task','shifts', 'user'));
    }
    
    //marcar tarea como hecha
    public function markTask(Request $request, $task_id, $user_id){
        $this->shiftsService->createShift($user_id, $task_id);
        return redirect()->back()->with('status', 'Tarea marcada como realizada.');
    }
    
    //validar tarea
    public function validateShift(Request $request, $task_id, $user_id, $shift_id){
        $this->shiftsService->validateShiftbyId($user_id, $task_id, $shift_id);
        return redirect()->back()->with('status', 'Tarea marcada como realizada.');
    }
}
