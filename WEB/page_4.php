<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_4.css" />
    <title>Document</title>
</head>
<body>
    <div id="content">
        <div>
            <form method="POST" action="?page=0" class='formulaire'>
                <?php 
                if (isset($_GET['compte'])){
                    if ($_GET['compte']=="erreur"){
                        echo"<H2 class='erreur'>Erreur de connexion</H2>";
                    }
                }
                ?>

                <label id="title">Connexion</label><br>

                <label for="username" class="form_el">Username</label><br>
                <input type="text" id="username" name="username" class="form_el"><br>

                <label for="mdp" class="form_el">Mot de passe</label><br>
                <input type="text" id="mdp" name="mdp" class="form_el"><br>

                <input type="hidden" name="page" value="5">
                <input type="submit" value="Connexion" name="Connexion" class="button">
            </form>
        </div>
    </div>
</body>
