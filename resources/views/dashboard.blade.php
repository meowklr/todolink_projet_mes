{{-- vue: dashboard --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    {{-- setup page principale --}}
    <section class="page">
        <section class="main_container">
            {{-- setup navbar --}}
            <div class="navbar">
                <a href="{{ route('home') }}" class="nav_logo"><img src="{{ asset('images/Logo_TODOLINK.png') }}" alt="Logo ToDoLink"></a>
                <div class="navbar_elements">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('dashboard') }}">Tableau de Bord</a>
                    <a href="{{ route('task_add') }}">Nouvelle tâche</a>
                </div>
                <div class="auth_buttons">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn--solid">Se connecter</a>
                    @endguest

                    @auth
                        @php
                            $fullName = trim((string) (auth()->user()->name ?? auth()->user()->email ?? 'Compte'));
                            $firstName = explode(' ', $fullName)[0] ?? 'Compte';
                        @endphp
                        <div class="account_menu" data-account-menu>
                            <button type="button" class="btn btn--solid account_trigger" data-account-trigger aria-expanded="false">{{ $firstName }}</button>
                            <div class="account_popup" data-account-popup>
                                <a href="{{ route('profile.edit') }}" class="btn btn--solid account_action">Voir mon compte</a>
                                <form method="POST" action="{{ route('logout') }}" class="account_form">
                                    @csrf
                                    <button type="submit" class="btn btn--solid account_action account_action--button">Se deconnecter</button>
                                </form>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
            {{-- setup contenu dashboard --}}
            <section class="content dashboard_content">
                <h1>Votre programme</h1>
                <p>Suivez vos tâches en cours et mettez à jour leur état.</p>

                @if (session('success'))
                    <p>{{ session('success') }}</p>
                @endif

                <section class="Tasks">
                    @forelse ($tasks as $task)
                        <div class="Task">
                            <div class="colonne-gauche">
                                <h3>{{ $task->title }}</h3>
                                <p>{{ $task->description ?: 'Aucune description' }}</p>
                                <p>Date: {{ \Carbon\Carbon::parse($task->task_date)->format('d/m/Y') }}</p>
                            </div>
                            <div class="colonne-droite">
                                <p>Collaborateur(s): {{ $task->username }}</p>
                                @php
                                    // on detecte si le fichier peut etre telecharge
                                    $hasDownloadableFile = !empty($task->file) && str_starts_with($task->file, 'tasks/');
                                    $displayFile = 'Aucun fichier';

                                    if (!empty($task->file)) {
                                        // affichage
                                        $rawFileName = $hasDownloadableFile ? basename($task->file) : $task->file;
                                        $extension = pathinfo($rawFileName, PATHINFO_EXTENSION);
                                        $baseName = pathinfo($rawFileName, PATHINFO_FILENAME);
                                        $baseName = preg_replace('/^\d+_/', '', $baseName) ?? $baseName;
                                        $shortBaseName = \Illuminate\Support\Str::limit($baseName, 16, '...');
                                        $displayFile = $extension ? $shortBaseName.'.'.$extension : $shortBaseName;
                                    }
                                @endphp
                                @if ($hasDownloadableFile)
                                    {{-- lien de telechargement --}}
                                    <p>Fichier: <a href="{{ route('tasks.download', $task) }}">{{ $displayFile }}</a></p>
                                @else
                                    {{-- aucun fichier associe --}}
                                    <p>Fichier: {{ $displayFile }}</p>
                                @endif
                            </div>
                            <input type="checkbox" id="task{{ $task->id }}">
                            <label for="task{{ $task->id }}">Fait</label>
                        </div>
                    @empty
                        <div class="Task">
                            <div class="colonne-gauche">
                                <h3>Aucune tâche</h3>
                                <p>Commencez par ajouter une nouvelle tâche.</p>
                            </div>
                        </div>
                    @endforelse
                </section>

                <a href="{{ route('task_add') }}" class="btn btn--text main_btn">Nouvelle tâche</a>
            </section>
        </section>
    </section>
    <script src="{{ asset('account_menu.js') }}"></script>
</body>
</html>
