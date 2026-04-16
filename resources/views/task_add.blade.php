<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Tâche</title>
    <link rel="icon" href="{{ asset('images/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <link rel="stylesheet" href="{{ asset('task_add.css') }}">
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
                <form class="task_add" method="POST" action="{{ route('tasks.store') }}">
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
                                <li class="dropdown-item">Timéo </li>
                                <li class="dropdown-item">Nathan </li>
                                <li class="dropdown-item">Mathieu </li>
                                <li class="dropdown-item">Romain </li>
                                <li class="dropdown-item">Paul </li>
                                <li class="dropdown-item">Maxime </li>
                            </ul>
                        </div>
                        
                        <div class="boxCollaborateur"></div>
                        
                        
                        <label for="piece_jointe" class="btn">Choisir un fichier</label>
                        <input id="piece_jointe" type="file" class="file_input">
                        <p id="fichier_selectionne" class="file_name_preview">Aucun fichier sélectionné</p>
                        <br><br><br><br><br><br>
                        <input class = "btn submitbtn" type="submit" value="Ajouter la tache">
                    </div>
                </form>
            </section>
        </section>
    </section> 
    <script src="{{ asset('task_add.js') }}"></script>
</body>
</html>