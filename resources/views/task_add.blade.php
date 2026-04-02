<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Tâche</title>
    <link rel="stylesheet" href="task_add.css">
</head>
<body>
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
            <label for="collaborateurs">Collaborateurs</label>
            <button class="collaborateur">Voir les Collaborateurs</button>

            <label for="piece_jointe">Ajouter fichier</label>
            <input id="piece_jointe" type="file">

            <input type="submit" value="Ajouter la tache">
        </div>
    </div>
    
</body>
</html>