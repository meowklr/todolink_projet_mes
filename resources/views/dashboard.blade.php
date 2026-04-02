<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="{{ asset('style_dashboard.css') }}">
</head>
<body>
    <div class="navbar">
                <a href="{{ route('home') }}" class="nav_logo"><img src="{{ asset('images/Logo_TODOLINK.png') }}" alt="Logo ToDoLink"></a>
                <div class="navbar_elements">
                    <a href="{{ route('home') }}">Accueil</a>
                    <a href="{{ route('dashboard') }}">Tableau de Bord</a>
                    <a href="{{ route('task_add') }}">Nouvelle tâche</a>
                </div>
                <div class="auth_buttons">
                    <button class="btn">Se connecter</button>
                </div>
            </div>
    <section class="dashboard">
        <section class="content">
            <br>
            <h2>Votre programme</h2>
            <br>
            <br>
            <br>
            <section class="Tasks">
                <div class="Task">
                    <div class="colonne-gauche">
                        <h3>Tâche 1</h3>
                        <p>Description: Terminer le rapport mensuel</p>
                        <p>Date: 15/03/2023</p>
                    </div>
                    <div class="colonne-droite">
                        <p>Collaborateurs: John, Jane</p>
                        <br>
                    </div>
                    <input type="checkbox" id="task1">
                    <label for="task1">Fait</label>
                    <br>
                </div>
                <div class="Task">
                    <div class="colonne-gauche">
                        <h3>Tâche 2</h3>
                        <p>Description: Préparer la présentation</p>
                        <p>Date: 20/03/2023</p>
                    </div>
                    <div class="colonne-droite">
                        <p>Collaborateurs: Alice, Bob</p>
                        <br>
                    </div>
                    <input type="checkbox" id="task2">
                    <label for="task2">Fait</label>
                    <br>
                </div>
            </section>
            <br>
            <br>
            <br>
            <br>
            <button class="btn">Modifier une tâche</button>
        </section>
    </section>
</body>
</html>