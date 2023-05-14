<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($_GET['dark'])){
            $dark=$_GET['dark'];
            if ($_GET['dark']=="true"){
                echo " <link rel='stylesheet' href='DarkMode/page_2_dark.css' />";
            }
            else{
                echo "<link rel='stylesheet' href='page_2.css' />";
            }
        }
        else {
            echo "<link rel='stylesheet' href='page_2.css' />";
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
    <?php $user=$_GET["user"] ;
    echo"<H1>La bibliothèque de $user</H1>";
    ?>
    
	<div class="galerie">
        <?php   
            $sql="SELECT * FROM book JOIN own ON book.idBook= own.idBook JOIN utilisateur ON utilisateur.idUser=own.idUser WHERE utilisateur.username='$user'";
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $thumbnail=$row["thumbnail"];
                $title=$row["title"];
                $idBook=$row["idBook"];

                echo "<div class='item'>
                        <div>
                        <a href='?dark=$dark&page=livre'>
                            <img src='$thumbnail' alt='Votre image'>
                        </a>
                        </div>
                        <div class='overlay'>";
                            if (isset($_GET['user'])){
                                $user=$_GET['user'];
                                echo"<a href='?dark=$dark&page=livre&user=$user&book=$idBook'></a>";
                            }
                            else{
                                echo"<a href='?dark=$dark&page=livre&book=$idBook'></a>";
                            };
                            echo"<p class='titre'>$title</p>
                        </div>
                </div>";
            }
        ?> 
	</div>
</body>
</html>
