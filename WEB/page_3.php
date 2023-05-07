<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_1.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <?php $txt=$_POST["search"] ;
    echo"<H1>Recherche pour '$txt'</H1>";
    ?>
    
	<div class="galerie">
        <?php   
            $sql="SELECT * FROM book WHERE LOWER(title) LIKE '%$txt%'";
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

            if (mysqli_fetch_assoc($result)!=null){
                while ($row = mysqli_fetch_assoc($result)){
                    $thumbnail=$row["thumbnail"];
                    $title=$row["title"];
                    $idBook=$row["idBook"];
    
                    echo "<div class='item'>
                            <div>
                            <a href='?page=livre'>
                                <img src='$thumbnail' alt='Votre image'>
                            </a>
                            </div>
                            <div class='overlay'>";
                                if (isset($_GET['user'])){
                                    $user=$_GET['user'];
                                    echo"<a href='?page=livre&user=$user&book=$idBook'></a>";
                                }
                                else{
                                    echo"<a href='?page=livre&book=$idBook'></a>";
                                };
                                echo"<p class='titre'>$title</p>
                            </div>
                    </div>";
                }
            }
            else{
                echo"Aucun résultat n'est disponible pour la recherche : $txt";
            }

        ?> 
	</div>
</body>
</html>
