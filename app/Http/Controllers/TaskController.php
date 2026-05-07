<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Task;
use App\Models\User;
use App\Services\CalendarService;

class TaskController extends Controller
{
    // formulaire de creation de tache
    public function create()
    {
    $collaborateurs = User::orderBy('name')->get(['name', 'branche']);
    // liste simple de priorites pour le formulaire
    $priorites = collect([
        (object) ['name' => 'Haute'],
        (object) ['name' => 'Moyenne'],
        (object) ['name' => 'Basse'],
    ]);

    return view('task_add', compact('collaborateurs', 'priorites'));
    }
    
    // enregistrement de la tache
    public function store(Request $request)
    { 
        // validation cote serveur pour eviter les champs vides et fichiers trop lourds
        $request->validate([
            'username' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'task_date' => 'required|date',
            'file' => 'nullable|file|max:10240',
            'priority' => 'required|in:Haute,Moyenne,Basse'
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

            // horodatage pour eviter les collisions de noms
            $storedName = now()->timestamp.'_'.$safeBaseName;
            if ($extension !== '') {
                $storedName .= '.'.$extension;
            }

            // la base enregistre le chemin du fichier pour le telechargement
            $fileName = $request->file('file')->storeAs('tasks', $storedName);
        }
        
        $task = Task::create([
            'username' => $request->username,
            'title' => $request->title,
            'description' => $request->description,
            'task_date' => $request->task_date,
            'file' => $fileName,
            'priority' => $request->input('priority'),
        ]);

        // Créer un événement calendrier
        $calendarService = new CalendarService();
        $calendarService->createCalendarEvent($task);

        return redirect()->route('dashboard')->with('success', 'Tache ajoutée.');
    }

    public function download(Task $task)
    {
        // pas de telechargement si le fichier est absent
        if (empty($task->file) || !Storage::disk('local')->exists($task->file)) {
            return redirect()->route('dashboard')->with('success', 'Fichier introuvable pour cette tache.');
        }

        // telechargement depuis le dashboard
        $downloadName = basename($task->file);
        return response()->download(Storage::disk('local')->path($task->file), $downloadName);
    }

    // liste pour le dashboard
    public function index()
    {
        $tasks = Task::orderBy('task_date', 'asc')->get();
        return view('dashboard', compact('tasks'));
    }
}