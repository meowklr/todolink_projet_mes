<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

Route::view('/', 'welcome')->name('home');
Route::view('/dashboard', 'dashboard')->name('dashboard');
Route::view('/task-add', 'task_add')->name('task_add');

Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
Route::get('/dashboard', [TaskController::class, 'index'])->name('tasks.dashboard');
