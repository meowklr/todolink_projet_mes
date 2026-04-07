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

                <section class="Tasks">
                    <div class="Task">
                        <div class="colonne-gauche">
                            <h3>Tâche 1</h3>
                            <p>Description: Terminer le rapport mensuel</p>
                            <p>Date: 15/03/2023</p>
                        </div>
                        <div class="colonne-droite">
                            <p>Collaborateurs: John, Jane</p>
                        </div>
                        <input type="checkbox" id="task1">
                        <label for="task1">Fait</label>
                    </div>

                    <div class="Task">
                        <div class="colonne-gauche">
                            <h3>Tâche 2</h3>
                            <p>Description: Préparer la présentation</p>
                            <p>Date: 20/03/2023</p>
                        </div>
                        <div class="colonne-droite">
                            <p>Collaborateurs: Alice, Bob</p>
                        </div>
                        <input type="checkbox" id="task2">
                        <label for="task2">Fait</label>
                    </div>
                </section>

                <a href="{{ route('task_add') }}" class="btn btn--text main_btn">Nouvelle tâche</a>
            </section>
        </section>
    </section>
</body>
</html>
