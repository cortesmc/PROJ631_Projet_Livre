<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($_GET['dark'])){
            $dark=$_GET['dark'];
            if ($_GET['dark']=="true"){
                echo " <link rel='stylesheet' href='DarkMode/page_4_dark.css' />";
            }
            else{
                echo "<link rel='stylesheet' href='page_4.css' />";
            }
        }
        else {
            echo "<link rel='stylesheet' href='page_4.css' />";
            $dark='false';
        }
    ?>
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    <title>Document</title>
</head>
<div class = "container">
    <div>
        <form method="POST" action="?dark=$dark&page=0" class='formulaire'>
            <?php 
            if (isset($_GET['compte'])){
                if ($_GET['compte']=="erreur"){
                    echo"<H2 class='erreur'>Erreur de connexion</H2>";
                }
            }
            ?>

            <label id="title">Connexion</label><br>
            <div id = "ligns">
            <div class ="ligne">
                <label for="username" class="form_el">Username</label><br>
                <input type="text" id="username" name="username" class="form_el"><br>
            </div>
            <div class ="ligne">
                <label for="mdp" class="form_el">Mot de passe</label><br>
                <input type="password" id="mdp" name="mdp" class="form_el"><br>
            </div>
            </div>
                <input type="hidden" name="page" value="5">
                <input type="submit" value="Connexion" name="Connexion" class="button" id="connexion">
        </form>
    </div>
</div>
