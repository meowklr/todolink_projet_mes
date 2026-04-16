<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    //formulaire d'ajout de tâche
    public function create()
    {
    $collaborateurs = User::orderBy('name')->get(['name']);
    return view('task_add', compact('collaborateurs'));
    }
    
    //enregistrement de la tâche
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'task_date' => 'required|date',
        ]);
        
        Task::create([
            'username' => $request->username,
            'title' => $request->title,
            'description' => $request->description,
            'task_date' => $request->task_date,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tache ajoutée.');
    }

    //dashboard
    public function index()
    {
        $tasks = Task::orderBy('task_date', 'asc')->get();
        return view('dashboard', compact('tasks'));
    }
}