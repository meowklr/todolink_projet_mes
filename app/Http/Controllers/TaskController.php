<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\User;

class TaskController extends Controller
{
    //formulaire d'ajout de tâche
    public function create()
    {
    $collaborateurs = User::orderBy('name')->get(['name', 'branche']);
    return view('task_add', compact('collaborateurs'));
    }
    
    //enregistrement de la tâche
    public function store(Request $request)
    { 
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'task_date' => 'required|date',
            'file' => 'nullable|file|max:10240',
        ], [
            'file.uploaded' => 'Le fichier n\'a pas pu etre televerse (limite serveur).',
            'file.max' => 'Le fichier depasse 10 Mo.',
            'file.file' => 'Le fichier fourni est invalide.',
        ]);

        $fileName = null;
        if ($request->hasFile('file')) {
            // on garde un nom lisible puis on stocke dans storage/app/tasks
            $originalName = $request->file('file')->getClientOriginalName();
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $extension = $request->file('file')->getClientOriginalExtension();
            $safeBaseName = Str::slug($baseName);

            if ($safeBaseName === '') {
                $safeBaseName = 'fichier';
            }

            $storedName = now()->timestamp.'_'.$safeBaseName;
            if ($extension !== '') {
                $storedName .= '.'.$extension;
            }

            // la base enregistre le chemin du fichier
            $fileName = $request->file('file')->storeAs('tasks', $storedName);
        }
        
        Task::create([
            'username' => $request->username,
            'title' => $request->title,
            'description' => $request->description,
            'task_date' => $request->task_date,
            'file' => $fileName,
        ]);

        return redirect()->route('dashboard')->with('success', 'Tache ajoutée.');
    }

    public function download(Task $task)
    {
        // si le fichier est absent pas de download
        if (empty($task->file) || !Storage::disk('local')->exists($task->file)) {
            return redirect()->route('dashboard')->with('success', 'Fichier introuvable pour cette tache.');
        }

        // telechargement depuis le dashboard
        $downloadName = basename($task->file);
        return response()->download(Storage::disk('local')->path($task->file), $downloadName);
    }

    //dashboard
    public function index()
    {
        $tasks = Task::orderBy('task_date', 'asc')->get();
        return view('dashboard', compact('tasks'));
    }
}