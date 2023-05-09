<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_0.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Titre du projet</h1><br>
        <h3>Cadoux Lila / Carlos Cortes / Ferreira Mathieu / Lebon Mathys / Plebani Théo </h3><br>
        <h2>Description du projet :</h2><br>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Officiis accusantium quisquam facilis doloremque maxime, quis recusandae pariatur est corporis reiciendis quo asperiores harum voluptate molestiae cupiditate quidem incidunt accusamus, eaque praesentium quam in voluptatibus explicabo magnam nam. Incidunt, aliquid iste corporis aliquam officiis quasi porro sapiente similique totam tempora quo sit hic itaque ad voluptas. Nobis dicta placeat rerum eius deleniti. Labore ex adipisci debitis laudantium, soluta, alias quas sequi deserunt incidunt consequuntur accusantium. Laboriosam totam, autem eius commodi harum quis ad, consequatur perferendis ex at recusandae dolores excepturi deleniti exercitationem quaerat doloribus voluptas? Aliquam officiis asperiores eius explicabo placeat temporibus quis soluta eaque labore ipsum animi nobis culpa iste, et reiciendis tempora? Dolore velit earum corporis unde neque nulla, minima suscipit non et nemo iste accusantium, molestiae enim vero. Unde sit, odio, perspiciatis atque quae illum aliquid veniam hic ipsa quos vel facilis consequatur nam itaque saepe! Sunt aliquid enim distinctio natus, illo reprehenderit libero quisquam neque, repellat vel saepe ducimus quidem aperiam modi perspiciatis voluptas minima voluptatem fugit repudiandae explicabo architecto. Vero officiis magni qui omnis ab libero atque alias sequi ad dicta ducimus, at quod expedita? Nemo enim odit sunt beatae laborum velit ad eveniet natus est.</p>
        <br>
        <br>
        <H2>Liens utiles :</H2>

        <div class="liens">
            <?php
                if (isset($_GET["user"])){
                    $user=$_GET["user"];
                    echo"<a href='?page=4' class='liens_utiles'>Se deconnecter</a>";
                    echo"<a href='?page=5' class='liens_utiles'>Créer un compte</a>";
                    echo"<a href='?page=2&user=$user' class='liens_utiles'>Ma bibliothéque</a>";
                }
                else{
                    echo"<a href='?page=4' class='liens_utiles'>Se connecter</a>";
                    echo"<a href='?page=5' class='liens_utiles'>Créer un compte</a>";
                    echo"<a href='?page=4' class='liens_utiles'>Ma bibliothéque</a>";
                }

            ?>
        </div>
        
    </div>

</body>
</html>