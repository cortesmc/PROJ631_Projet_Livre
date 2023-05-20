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
                echo " <link rel='stylesheet' href='DarkMode/page_0_dark.css' />";
            }
            else{
                echo "<link rel='stylesheet' href='page_0.css' />";
            }
        }
        else {
            echo "<link rel='stylesheet' href='page_0.css' />";
            $dark='false';
        }
    ?>
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Books for advanced readers</h1><br>
        <h3>Cadoux Lila / Carlos Cortes / Ferreira Mathieu / Lebon Mathys / Plebani Théo </h3><br>
        <h2>Description du projet :</h2><br>
        <p>L’objectif de ce projet réalisé en PROJ631, est de travailler en collaboration par groupe de 5 regroupant plusieurs langages de programmation et technologies afin de créer une bibliothèque en ligne.<br> 
            Cette bibliothèque doit être accessible depuis un site internet depuis lequel, les utilisateurs peuvent se connecter, ajouter des livres à leurs bibliothèques, donner des commentaires et des notes sur les livres qu’ils ont lus. Ces commentaires sont ensuite visibles par l’ensemble des autres utilisateurs.<br> 
            Sur ce site il est aussi possible d’ajouter des utilisateurs en tant qu’ami afin d’avoir accès à leur bibliothèque.<br> 
            De plus, une interface administrateur existe depuis Java, permettant d’ajouter, supprimer et modifier les différents livres de la bibliothèque.</p><br>
        <br>
        <H2>Liens utiles :</H2>

        <div class="liens">
            <?php
                if (isset($_GET["user"])){
                    $user=$_GET["user"];
                    echo"<a href='?dark=$dark&page=4' class='liens_utiles'>Se deconnecter</a>";
                    echo"<a href='?dark=$dark&page=5' class='liens_utiles'>Créer un compte</a>";
                    echo"<a href='?dark=$dark&page=2&user=$user' class='liens_utiles'>Ma bibliothéque</a>";
                }
                else{
                    echo"<a href='?dark=$dark&page=4' class='liens_utiles'>Se connecter</a>";
                    echo"<a href='?dark=$dark&page=5' class='liens_utiles'>Créer un compte</a>";
                    echo"<a href='?dark=$dark&page=4' class='liens_utiles'>Ma bibliothéque</a>";
                }

            ?>
        </div>
        
    </div>

</body>
</html>