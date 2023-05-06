<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_1.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php $genre=$_GET["genre"] ;
    echo"<H1>$genre</H1>";
    ?>
    
	<div class="galerie">
        <?php   
            $sql="SELECT * FROM book JOIN belong ON book.idBook = belong.idBook JOIN genre ON belong.idGenre= genre.idGenre WHERE genre.libele = '$genre'";
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $thumbnail=$row["thumbnail"];
                $title=$row["title"];
                $idBook=$row["idBook"];
                $idGenre=$row["idGenre"];

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
        ?> 
	</div>
</body>
</html>
