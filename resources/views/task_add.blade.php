<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Tâche</title>
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
                <div class="task_add">
                    <div class="partie_droite colonne">
                        <label for="nom_tache">Nom de la tache</label>
                        <input id="nom_tache" type="text" placeholder="Nom de la tache">

                        <label for="descriptif">Description</label>
                        <textarea id="descriptif" placeholder="Decris la tache..."></textarea>

                        <label for="date_limite">Date limite</label>
                        <input id="date_limite" type="date">
                    </div>

                    <div class="barre"></div>

                    <div class="partie_gauche colonne">
                        <label for="collaborateurs"  >Collaborateurs</label>
                        <button class="collaborateur btn">Ajouter les Collaborateurs</button>
                        <div class="collaborateur_present">
                            <p>Timéo</p>
                            <p>Nathan</p>
                            <p>Mathieu</p>
                        </div>
                        
                        <label for="piece_jointe" class="btn">Choisir un fichier</label>
                        <input id="piece_jointe" type="file" class="file_input">
                        <br><br><br><br><br><br>
                        <input  class = "btn" type="submit" value="Ajouter la tache">
                    </div>
                </div>
            </section>
        </section>
    </section>
    
    
</body>
</html>