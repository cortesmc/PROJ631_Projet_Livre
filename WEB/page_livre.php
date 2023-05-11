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
                echo " <link rel='stylesheet' href='DarkMode/page_livre_dark.css' />";
            }
            else{
                echo "<link rel='stylesheet' href='page_livre.css' />";
            }
        }
        else {
            echo "<link rel='stylesheet' href='page_livre.css' />";
            $dark='false';
        }
    ?>
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    <title>Document</title>
</head>

<?php
    if((isset($_GET["user"]))&&(!isset($_GET["note"]))){
        $user=$_GET["user"];
        $book=$_GET["book"];


        $sql="SELECT note FROM review WHERE (((SELECT idUser FROM utilisateur WHERE username='$user')=review.idUser) AND (review.idBook='$book'))";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $note= $row["note"];
            $query_string = http_build_query(array('note' => $note));

            if (isset($_GET["com"])){
                header('Location: main_page.php?dark='.$dark.'&page=livre&user='.$user.'&book='.$book.'&' . $query_string . '&com=true');
            }
            else{
                header('Location: main_page.php?dark='.$dark.'&page=livre&user='.$user.'&book='.$book.'&' . $query_string);
            }

            
        }
    }
    

    if (isset($_POST["submit"])){
        $user=$_GET["user"];
        $book=$_GET["book"];
        $sql="INSERT INTO own (idUser,idBook) VALUES ((SELECT idUser FROM utilisateur WHERE username='$user'),'$book')";
        mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
    }

    else if (isset($_POST["submit_none"])){
        $user=$_GET["user"];
        $book=$_GET["book"];
        $sql="DELETE FROM own WHERE idUser=(SELECT idUser FROM utilisateur WHERE username='$user') AND idBook='$book'";
        mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
    }


    else if (isset($_POST["btn"])){
        $note=$_GET["note"];
        $book=$_GET["book"];

        $sql="SELECT * FROM review WHERE ((SELECT idUser FROM utilisateur WHERE username='$user')=review.idUser) AND (review.idBook='$book')";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

        if((mysqli_fetch_assoc($result))!=null){
                $sql="UPDATE review SET note = '$note' WHERE (review.idUser=(SELECT idUser FROM utilisateur WHERE username='$user')) AND (review.idBook='$book')";
                mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        }
        else{
            $sql="INSERT INTO review (note, idBook,idUser) VALUES ('$note','$book',(SELECT idUser FROM utilisateur WHERE username='$user'))";
            mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        }

        
    }

    else if (isset($_POST["send_com"])){
        if(isset($_POST['options'])) {
            $nb_etoile = $_POST['options'];
        }
        $texte=$_POST["message"];
        
        $sql="SELECT * FROM review WHERE (review.idUser=(SELECT idUser FROM utilisateur WHERE username='$user'))";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        if (mysqli_num_rows($result) > 0){
            $sql="UPDATE review SET note = '$nb_etoile', descr='$texte' WHERE (review.idUser=(SELECT idUser FROM utilisateur WHERE username='$user')) AND (review.idBook='$book')";
            mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
            header('Location: main_page.php?dark='.$dark.'&page=livre&user='.$user.'&book='.$book.'&note=' . $nb_etoile);
        }
        else{
            $sql="INSERT INTO review (note, descr,idBook,idUser) VALUES ('$nb_etoile','$texte','$book',(SELECT idUser FROM utilisateur WHERE username='$user'))";
            mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
            header('Location: main_page.php?dark='.$dark.'&page=livre&user='.$user.'&book='.$book.'&note=' . $nb_etoile);
        }
    }


?>



<body>
    <?php 

        $idBook=$_GET["book"] ;
        $sql="SELECT * FROM book JOIN iswrite ON book.idBook=iswrite.idBook JOIN author ON iswrite.idAuthor=author.idAuthor WHERE book.idBook='$idBook'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        while ($row = mysqli_fetch_assoc($result)){
            $thumbnail=$row["thumbnail"];
            $title=$row["title"];
            $author=$row["name"];
        }
    ?>
    

	<div class="container">
		<div class="image-container">
            <?php echo"<img src=$thumbnail alt='Image'>";?>
            <?php 
                if(isset($_GET["user"])){
                    $user=$_GET["user"];
                    $book=$_GET["book"];


                    echo"<div class='rating'>";
                    if (isset($_GET["note"])){
                        if ($_GET["note"]==1){
                            echo"
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                                <button name='btn' id='btn4'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                                <button name='btn' id='btn3'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                                <button name='btn' id='btn2'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                                <button name='btn' id='btn1' class='note_true'>★</button>
                            </form>
                            ";
                        }
                        if ($_GET["note"]==2){
                            echo"
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                                <button name='btn' id='btn4'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                                <button name='btn' id='btn3'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                                <button name='btn' id='btn2' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                                <button name='btn' id='btn1' class='note_true'>★</button>
                            </form>
                            ";
                        }
                        if ($_GET["note"]==3){
                            echo"
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                                <button name='btn' id='btn4'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                                <button name='btn' id='btn3' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                                <button name='btn' id='btn2' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                                <button name='btn' id='btn1' class='note_true'>★</button>
                            </form>
                            ";
                        }
                        if ($_GET["note"]==4){
                            echo"
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                                <button name='btn' id='btn4' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                                <button name='btn' id='btn3' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                                <button name='btn' id='btn2' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                                <button name='btn' id='btn1' class='note_true'>★</button>
                            </form>
                            ";
                        }
                        if ($_GET["note"]==5){
                            echo"
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                                <button name='btn' id='btn4' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                                <button name='btn' id='btn3' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                                <button name='btn' id='btn2' class='note_true'>★</button>
                            </form>
                            <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                                <button name='btn' id='btn1' class='note_true'>★</button>
                            </form>
                            ";
                        }
                        
                    }else{
                        echo"
                        <form action='?dark=$dark&page=livre&user=$user&book=$book&note=5' method='post'>
                            <button name='btn' id='btn5'>★</button>
                        </form>
                        <form action='?dark=$dark&page=livre&user=$user&book=$book&note=4' method='post'>
                            <button name='btn' id='btn4'>★</button>
                        </form>
                        <form action='?dark=$dark&page=livre&user=$user&book=$book&note=3' method='post'>
                            <button name='btn' id='btn3'>★</button>
                        </form>
                        <form action='?dark=$dark&page=livre&user=$user&book=$book&note=2' method='post'>
                            <button name='btn' id='btn2'>★</button>
                        </form>
                        <form action='?dark=$dark&page=livre&user=$user&book=$book&note=1' method='post'>
                            <button name='btn' id='btn1'>★</button>
                        </form>
                        ";
                    }
                echo"</div>";
                echo"<p class='note'>Votre note</p>";





                    $sql="SELECT * FROM own WHERE ((SELECT idUser FROM utilisateur WHERE username='$user')=own.idUser) AND (own.idBook='$book')";
                    $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);


                    if((mysqli_fetch_assoc($result))==null){
                        echo"<form action='?dark=$dark&page=livre&user=$user&book=$book' method='POST'><input type='submit' name='submit' class='aujout_liste' value='Ajouter à ma Bibliotéque'></form>";
                    }
                    else{
                        echo"<form action='?dark=$dark&page=livre&user=$user&book=$book' method='POST'><input type='submit' name='submit_none' class='aujout_liste' value='Retirer de ma Bibliotéque'></form>";
                    }
                }
            ?>
            
		</div>
		<div class="text-container">
            <?php echo"<H1>$title</H1>";?>
            <?php echo"<H2>$author</H2>";?>

            <?php
                $book=$_GET["book"];
                $sql="SELECT ROUND(AVG(note),1) AS moyenne FROM review WHERE idBook=$book";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
                $row = $row = mysqli_fetch_assoc($result);
                $moyenne=$row["moyenne"];

                $sql="SELECT COUNT(note) AS nb_review FROM review WHERE idBook=$book";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
                $row = $row = mysqli_fetch_assoc($result);
                $nb_review=$row["nb_review"];

                $sql="SELECT COUNT(descr) AS nb_com FROM review WHERE idBook=$book";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
                $row = $row = mysqli_fetch_assoc($result);
                $nb_com=$row["nb_com"];


                echo"<p class='moyenne'>Note: <span class='petite_etoile'>★</span> ($moyenne)  <span class='petit_span'>($nb_review review) ($nb_com commentaire)</span></p>";
                


            echo"<br>";
			echo"<p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
			<p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
			
            <br>
            <H1 class='commentaire'>Commentaire <span class='span_gros_com'>($nb_com commentaires)</span></H1>";

            if ((isset($_GET["user"]))&&(!isset($_GET["com"]))){
                echo"<form action='?dark=$dark&page=livre&user=$user&book=$book&com=true' method='POST'>
                <input type='submit' name='write_com' class='write_com' value='Ecrire un commentaire'>
                </form>";
            }


                        
            if (isset($_GET["com"])){
                echo"<form action='?dark=$dark&page=livre&user=$user&book=$book' method='POST' class='add_com_div'>
                    <label class='votre_com'>Votre commentaire</label><br>
                    <label class='nb_etoile'>Nombre d'étoiles :</label>
                    <label><input type='radio' name='options' value='1' class='rbtn'> 1</label>
                    <label><input type='radio' name='options' value='2' class='rbtn'> 2</label>
                    <label><input type='radio' name='options' value='3' class='rbtn'> 3</label>
                    <label><input type='radio' name='options' value='4' class='rbtn'> 4</label>
                    <label><input type='radio' name='options' value='5' class='rbtn'> 5</label>
                    <br>
                    <textarea id='message' name='message' rows='8' cols='80' resize='none' placeholder='Ecrire votre commentaire ici... (Ne pas mettre de guillemets simple et double)'></textarea>
                    <input type='submit' name='send_com' class='send_com' value='Publier'>
                </form>";
            }


            
            $sql="SELECT * FROM review JOIN utilisateur ON review.idUser=utilisateur.idUser WHERE review.idBook='$book'";
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
            while ($row = mysqli_fetch_assoc($result)){
                $user_com=$row["username"];
                $note_com=$row["note"];
                $description=$row["descr"];

                echo"
                    <div class='commentaire_div'>
                        <p><span class='user_com'>$user_com   </span>($note_com <span class='petite_etoile'>★</span>)</p>
                        <div>$description</div>
                    </div>
                ";
            }


            
            ?>
            
        </div>
	</div>
</body>
</html>
