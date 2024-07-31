<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Task;
use App\Models\Shifts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\TaskService;
use App\Services\ShiftService;
use App\Services\RoleService;
use App\Services\UserService;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $taskService;
    protected $shiftsService;
    protected $roleService;
    protected $UserService;

    public function __construct(TaskService $taskService, ShiftService $shiftService, RoleService $rolService, UserService $userService){
        $this->taskService      = $taskService;
        $this->shiftsService    = $shiftService;
        $this->roleService      = $rolService;
        $this->UserService      = $userService;
    }
    
    //mostrar dashboard
    public function index()
    {
        return view('dashboard');
    }

     //mostrar tareas
     public function show($id){
        $user = $this->UserService->find(Auth::id());
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
