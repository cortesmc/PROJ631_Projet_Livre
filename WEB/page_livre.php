<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_livre.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
    <title>Document</title>
</head>

<?php
    if (isset($_POST["submit"])){
        $user=$_GET["user"];
        $book=$_GET["book"];
        $sql="INSERT INTO own (idUser,idBook) VALUES ((SELECT idUser FROM utilisateur WHERE username='$user'),'$book')";
        mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
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
            <div class='rating'>
                <form action="">
                    <button name='btn5' id='btn5'>★</button>
                </form>
                <form action="">
                    <button name='btn4' id='btn4'>★</button>
                </form>
                <form action="">
                    <button name='btn3' id='btn3'>★</button>
                </form>
                <form action="">
                    <button name='btn2' id='btn2'>★</button>
                </form>
                <form action="">
                    <button name='btn1' id='btn1'>★</button>
                </form>
            </div>
            <p class='note'>Votre note</p>
            <?php 
                if(isset($_GET["user"])){
                    $user=$_GET["user"];
                    $book=$_GET["book"];
                    $sql="SELECT * FROM own WHERE ((SELECT idUser FROM utilisateur WHERE username='$user')=own.idUser) AND (own.idBook='$book')";
                    $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);


                    if((mysqli_fetch_assoc($result))==null){

                        echo"<form action='?page=livre&user=$user&book=$book' method='POST'><input type='submit' name='submit' class='aujout_liste' value='Ajouter à ma Bibliotéque'></form>";
                    }
                }
            ?>
            
		</div>
		<div class="text-container">
            <?php echo"<H1>$title</H1>";?>
            <?php echo"<H2>$author</H2>";?>
            <p>Note</p>
            <br>
			<p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
			<p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
			
            <br>
            <H1>Commentaire</H1>
            <p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
			<p>Nam pulvinar justo a enim eleifend, sit amet commodo nulla consectetur. Duis nec tempor justo. Sed consequat consequat nibh, sit amet commodo eros lacinia vel. Aenean vitae elementum velit. Aliquam interdum mi in nunc pharetra eleifend. Aenean eleifend, ex nec faucibus egestas, elit elit blandit elit, in fermentum nisi nibh a diam. Nunc bibendum lectus id erat maximus, eu dictum dolor tincidunt. Nulla commodo auctor erat vel dapibus. Morbi facilisis tincidunt nisi, sed aliquam elit dapibus vel. In hac habitasse platea dictumst. Integer auctor, mauris nec commodo hendrerit, quam turpis sollicitudin est, vel lacinia neque felis eu metus. Nullam consequat mi quis velit pharetra faucibus.</p>
		</div>
	</div>
</body>
</html>
