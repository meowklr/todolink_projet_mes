<?php

// routes principales
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

// route accueil
Route::view('/', 'welcome')->name('home');
// route dashboard
Route::get('/dashboard', [TaskController::class, 'index'])->name('dashboard');
// route ajout tache
Route::get('/task-add', [TaskController::class, 'create'])->name('task_add');

// routes taches
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
// route de telechargement du fichier lie a une tache
Route::get('/tasks/{task}/download', [TaskController::class, 'download'])->name('tasks.download');

// routes profil protegees
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes auth
require __DIR__.'/auth.php';
