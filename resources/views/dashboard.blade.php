<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style_dashboard.css">
</head>
<body>
    <div class="navbar">
                <a href="index.html" class="nav_logo"><img src=img/Logo_TODOLINK.png alt="Logo ToDoLink"></a>
                <div class="navbar_elements">
                    <a href="index.html">Accueil</a>
                    <a href="dashboard.html">Tableau de Bord</a>
                    <a href="task_add.html">Nouvelle tâche</a>
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