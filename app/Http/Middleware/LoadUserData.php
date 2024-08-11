<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Task;
use App\Models\Shifts;

class LoadUserData
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $tasks = Task::all();
            $shifts = Shifts::orderBy('completed_at', 'desc')->take(15)->get();

            view()->share('user', $user);
            view()->share('tasks', $tasks);
            view()->share('shifts', $shifts);
        }

        return $next($request);
    }
}
