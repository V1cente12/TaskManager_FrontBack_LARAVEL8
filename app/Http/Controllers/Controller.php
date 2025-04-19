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
use App\Services\RoleHasPermissionsService;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $taskService;
    protected $shiftsService;
    protected $roleService;
    protected $UserService;
    protected $roleHasPermissionsService;

    public function __construct(TaskService $taskService, ShiftService $shiftService, RoleService $rolService, UserService $userService , RoleHasPermissionsService $roleHasPermissionsService){
        $this->taskService                  = $taskService;
        $this->shiftsService                = $shiftService;
        $this->roleService                  = $rolService;
        $this->UserService                  = $userService;
        $this->roleHasPermissionsService    = $roleHasPermissionsService;
    }
    
    //mostrar dashboard
    public function index(){
        $tasks = Task::where('active',true)->get();
        return view('dashboard', compact('tasks'));
    }

    public function assignRole(Request $request){
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $this->roleHasPermissionsService->assignRole(Auth::id(), $request->role_id);
        
        alert()->success('Éxito', 'Rol asignado exitosamente.');
        return redirect()->route('dashboard');
    }
    
    public function createTask(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ], [
            'name.required' => 'El nombre de la tarea es obligatorio.',
            'description.required' => 'La descripción de la tarea es obligatoria.',
        ]);
        $this->taskService->create([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        alert()->success('Éxito', 'Tarea creada exitosamente.');

    return redirect()->back();
    }

    public function updateTask(Request $request, $task_id){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ], [
            'name.required' => 'El nombre de la tarea es obligatorio.',
            'description.required' => 'La descripción de la tarea es obligatoria.',
        ]);
        $this->taskService->update($task_id, [
            'name' => $request->name,
            'description' => $request->description,
        ]);
        alert()->info('Éxito', 'Tarea actualizada exitosamente.');
        return redirect()->back();
    }

    public function deleteTask($task_id){
        $this->taskService->delete($task_id);
        alert()->error('Éxito', 'Tarea eliminada exitosamente.');
        return redirect()->route('dashboard');
    }
     
    public function show($id){
        $user = $this->UserService->find(Auth::id());
        $task   = $this->taskService->find($id);   
        $shifts = $this->shiftsService->findbytask($id);
        return view('tasks.show', compact('task','shifts', 'user'));
    }
    
    //marcar tarea como hecha
    public function markTask(Request $request, $task_id, $user_id){
        $this->shiftsService->createShift($user_id, $task_id);
        alert()->success('Éxito', 'La tarea se marcó como realizada correctamente.');
        return redirect()->back();
    }
    
    //validar tarea
    public function validateShift(Request $request, $task_id, $user_id, $shift_id){
        $this->shiftsService->validateShiftbyId($user_id, $task_id, $shift_id);
        alert()->success('Éxito', 'Validaste la tarea.');
        return redirect()->back();
    }
}
