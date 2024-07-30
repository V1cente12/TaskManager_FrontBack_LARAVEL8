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
use App\Services\UserService;

class TaskController extends Controller
{
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
}
