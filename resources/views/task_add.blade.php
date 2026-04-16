<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Tâche</title>
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
            <section class="content">
                <form class="task_add" method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="username" id="username">
                    <div class="partie_gauche colonne">
                        <label for="nom_tache">Nom de la tache</label>
                        <input id="nom_tache" name="title" type="text" placeholder="Nom de la tache">

                        <label for="descriptif">Description</label>
                        <textarea id="descriptif" name="description" placeholder="Decris la tache..."></textarea>

                        <label for="date_limite">Date limite</label>
                        <input id="date_limite" name="task_date" type="date">
                    </div>

                    <div class="barre"></div>

                    <div class="partie_droite colonne">
                        <label for="collaborateurs">Collaborateurs</label>
                        <div class="dropdown">
                            <button type="button" class="dropdownBtn btn" id="dropdownBtn">Sélectionner un collaborateur</button>
                            <ul class="dropdown-list" id ="dropdownList">
                                @foreach ($collaborateurs as $collaborateur)
                                    <li class="dropdown-item" data-name="{{ $collaborateur->name }}"> {{ $collaborateur->name }} - {{ $collaborateur->branche}} </li>
                                @endforeach
                            </ul>
                        </div>
                        
                        <div class="boxCollaborateur"></div>
                        
                        
                        <label for="piece_jointe" class="btn">Choisir un fichier</label>
                        <input id="piece_jointe" name="file" type="file" class="file_input">
                        <p id="fichier_selectionne" class="file_name_preview">Aucun fichier sélectionné</p>
                        <br><br><br><br><br><br>
                        <input class="btn btn--solid submitbtn" type="submit" value="Ajouter la tache">
                    </div>
                </form>
            </section>
        </section>
    </section> 
    <script src="{{ asset('task_add.js') }}"></script>
    <script src="{{ asset('account_menu.js') }}"></script>
</body>
</html>