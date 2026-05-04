{{-- vue: auth --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('images/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('style.css') }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        @php
            // adapte les titres en fonction de la page auth courante
            $authTitle = match (true) {
                request()->routeIs('login') => 'Heureux de vous revoir',
                request()->routeIs('register') => 'Créez votre compte',
                request()->routeIs('password.request') => 'Mot de passe oublié',
                request()->routeIs('password.reset') => 'Réinitialisation du mot de passe',
                request()->routeIs('verification.notice') => 'Vérification de votre email',
                default => 'Espace compte',
            };

            $authSubtitle = match (true) {
                request()->routeIs('login') => 'Connectez-vous pour continuer sur todolink.',
                request()->routeIs('register') => 'Rejoignez la plateforme en quelques secondes.',
                request()->routeIs('password.request') => 'Nous allons vous envoyer un lien de réinitialisation.',
                request()->routeIs('password.reset') => 'Choisissez un nouveau mot de passe sécurisé.',
                request()->routeIs('verification.notice') => 'Confirmez votre adresse email pour activer votre compte.',
                default => 'Gérez votre accès à la plateforme.',
            };

            $authCrumb = match (true) {
                request()->routeIs('login') => 'Connexion',
                request()->routeIs('register') => 'Inscription',
                request()->routeIs('password.request') => 'Mot de passe oublié',
                request()->routeIs('password.reset') => 'Réinitialisation',
                request()->routeIs('verification.notice') => 'Vérification email',
                default => 'Compte',
            };
        @endphp

        {{-- setup page principale --}}
        <section class="page auth_page">
            <section class="main_container auth_main_container">
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
                            <a href="{{ route('login') }}" class="btn btn--solid {{ request()->routeIs('login') ? 'auth_nav_current' : '' }}">Se connecter</a>
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

                {{-- setup contenu auth --}}
                <section class="content auth_content">
                    {{-- entete de la page auth --}}
                    <div class="auth_header">
                        <p class="auth_breadcrumb"><a href="{{ route('home') }}">Accueil</a> / {{ $authCrumb }}</p>
                        <h1>{{ $authTitle }}</h1>
                        <p>{{ $authSubtitle }}</p>
                    </div>

                    {{-- carte qui contient le formulaire --}}
                    <div class="auth_card">
                        {{ $slot }}
                    </div>
                </section>
            </section>
        </section>
        <script src="{{ asset('account_menu.js') }}"></script>
    </body>
</html>
