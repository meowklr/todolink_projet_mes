<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    //formulaire d'ajout de tâche
    public function create()
    {
        return view('task_add');
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

        return redirect()->back()->with('success', 'Tache ajoutée.');
    }

    //dashboard
    public function index()
    {
        $tasks = Task::orderBy('task_date', 'asc')->get();
        return view('tasks.index', compact('tasks'));
    }
}