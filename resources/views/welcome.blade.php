<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ToDoLink</title>
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
            <section class="content">
                <a class="app_logo"><img src="{{ asset('images/Logo_app_TODOLINK.png') }}" alt="Logo de l'application"></a>
                <h1>Bienvenue sur ToDoLink</h1>
                <p>Votre logiciel de gestion de tâches en ligne.</p>
                <a href="{{ route('dashboard') }}" class="btn btn--text main_btn">Commencer</a>
            </section>
        </section>
    </section>

</body>
</html>