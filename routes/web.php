<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/refresco', function () {
    return view('refresco');
})->middleware(['auth'])->name('refresco');

Route::get('/basura', function () {
    return view('basura');
})->middleware(['auth'])->name('basura');

Route::get('/agua', function () {
    return view('agua');
})->middleware(['auth'])->name('agua');

Route::get('/arena', function () {
    return view('arena');
})->middleware(['auth'])->name('arena');

Route::get('/patio', function () {
    return view('patio');
})->middleware(['auth'])->name('patio');

require __DIR__.'/auth.php';
