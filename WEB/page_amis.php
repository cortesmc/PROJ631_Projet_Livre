<?php
    if ((isset($_POST["add_friend"]))){
        $idfriend=$_GET["amis"];
        $user=$_GET["user"];
        $dark=$_GET["dark"];
        $sql="INSERT INTO isfriend (idFriend1,idFriend2) VALUES ((SELECT idUser FROM utilisateur WHERE username='$user'),$idfriend)";
        mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        header('Location: main_page.php?dark='.$dark.'&page=amis&user='.$user.'&amis=home');
        
    }

    if ((isset($_POST["remove_friend"]))){
        $idfriend=$_GET["amis"];
        $user=$_GET["user"];
        $dark=$_GET["dark"];
        $sql="DELETE FROM isfriend WHERE idFriend1=(SELECT idUser FROM utilisateur WHERE username='$user') AND idFriend2='$idfriend'";
        mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        header('Location: main_page.php?dark='.$dark.'&page=amis&user='.$user.'&amis=home');
        
    }

?>
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
                echo " <link rel='stylesheet' href='DarkMode/page_amis_dark.css' />";
            }
            else{
                echo "<link rel='stylesheet' href='page_amis.css' />";
            }
        }
        else {
            echo "<link rel='stylesheet' href='page_amis.css' />";
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
<?php
if ($_GET["amis"]=='home'){
    echo"<div class='container'>
		<div class='liste_user'>
            <H1>Utilisateurs</H1>
            <div class='content_liste_user'>";
                $sql="SELECT idUser,username FROM utilisateur WHERE username!='$user'";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $id=$row["idUser"];
                    $username=$row["username"];
                    echo"<form action='?dark=$dark&page=amis&user=$user&amis=$id' method='POST' class='userForm'>
                    <div class='ligne_users'>
                    <label>$username</label>";
                    
                    $sql2="SELECT * FROM isfriend WHERE idFriend1=(SELECT idUser FROM utilisateur WHERE username='$user') AND idFriend2='$id'";
                    $result2 = mysqli_query($conn, $sql2) or die("Requête invalide: ". mysqli_error()."\n".$sql2);
                    if (!mysqli_num_rows($result2) > 0){
                        echo"<input type='submit' name='add_friend' class='aujout_liste' value='Add User'>";
                    }
                    else{
                        echo"<input type='submit' name='remove_friend' class='aujout_liste' value='Remove User'>";
                    }
                    echo"</form></div>";
                }
                
            echo"</div>
		</div>
		<div class='liste_amis'>
            <H1>Mes amis</H1>
            <div class='content_liste_amis'>";
                $sql="SELECT idFriend2 FROM utilisateur JOIN isfriend ON utilisateur.idUser=isfriend.idFriend1 WHERE utilisateur.username='$user'";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
                while ($row = mysqli_fetch_assoc($result)){
                    $id2=$row["idFriend2"];
                    $sql2="SELECT * FROM utilisateur WHERE idUser='$id2'";
                    $result2 = mysqli_query($conn, $sql2) or die("Requête invalide: ". mysqli_error()."\n".$sql2);
                    while ($row2 = mysqli_fetch_assoc($result2)){
                        $id=$row2["idUser"];
                        $username=$row2["username"];;
                        echo"<form action='?dark=$dark&page=amis&user=$user&amis=$id' method='POST' class='amisForm'>
                        <div class='ligne_amis'>
                        <label>$username</label>
                        <input type='submit' name='submit' class='aujout_liste' value='Voir biblio'>
                        </div></form>";
                    }
                }               
            echo"</div>
        </div>
	</div>";
}
else{
    $friend=$_GET["amis"] ;
    $sql="SELECT username FROM utilisateur WHERE idUSer=$friend";
    $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
    while ($row = mysqli_fetch_assoc($result)){
        $namefriend=$row["username"];
    }
    echo"<H1>La bibliothèque de $namefriend</H1>
    
	<div class='galerie'>";
            $sql="SELECT * FROM book JOIN own ON book.idBook= own.idBook JOIN utilisateur ON utilisateur.idUser=own.idUser WHERE utilisateur.idUser='$friend'";
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
	echo"</div>";
}

?>
</body>
</html>