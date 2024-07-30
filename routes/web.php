<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

// routes/web.php
Route::get('/dashboard', [Controller::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::post('/mark-task/{task_id}/{user_id}', [Controller::class, 'markTask'])
    ->middleware('auth')
    ->name('mark-task');

Route::put('/validate-shift/{task_id}/{user_id}/{shift_id}', [Controller::class, 'validateShift'])
    ->middleware('auth')
    ->name('validate-shift');

    // routes/web.php
Route::get('/task/{id}', [Controller::class, 'show'])
    ->middleware('auth')
    ->name('task.show');

require __DIR__.'/auth.php';
