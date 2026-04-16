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
    <section class="page">
        <section class="main_container">
            <div class="navbar">
                <a href="{{ route('home') }}" class="nav_logo"><img src="{{ asset('images/Logo_TODOLINK.png') }}" alt="Logo ToDoLink"></a>
                <div class="navbar_elements">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('dashboard') }}">Tableau de Bord</a>
                    <a href="{{ route('task_add') }}">Nouvelle tâche</a>
                </div>
                <div class="auth_buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn--solid">Se connecter</a>
                        <a href="{{ route('register') }}" class="btn btn--solid">Creer un compte</a>
                    @endguest

                    @auth
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn--solid">Se deconnecter</button>
                        </form>
                    @endauth
                </div>
            </div>
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
                                <p>Description: {{ $task->description ?: 'Aucune description' }}</p>
                                <p>Date: {{ \Carbon\Carbon::parse($task->task_date)->format('d/m/Y') }}</p>
                            </div>
                            <div class="colonne-droite">
                                <p>Collaborateur(s): {{ $task->username }}</p>
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
</body>
</html>
