{{-- vue: accueil --}}
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - ToDoLink</title>
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
            {{-- setup contenu accueil --}}
            <section class="content">
                <a class="app_logo"><img src="{{ asset('images/Logo_app_TODOLINK.png') }}" alt="Logo de l'application"></a>
                <h1>Bienvenue sur ToDoLink</h1>
                <p>Votre logiciel de gestion de tâches en ligne.</p>
                <a href="{{ route('dashboard') }}" class="btn btn--text main_btn">Commencer</a>
            </section>
        </section>
    </section>

    <script src="{{ asset('account_menu.js') }}"></script>
</body>
</html>