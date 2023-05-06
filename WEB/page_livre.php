<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="page_livre.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php 

        $idBook=$_GET["book"] ;
        $sql="SELECT * FROM book WHERE idBook='$idBook'";
        $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);
        while ($row = mysqli_fetch_assoc($result)){
            $thumbnail=$row["thumbnail"];
            $title=$row["title"];
        }
    ?>
    <?php ?>

	<div class="container">
		<div class="image-container">
            <?php echo"<img src=$thumbnail alt='Image'>";?>
            <h2>Mettre la note ici</h2>
		</div>
		<div class="text-container">
            <?php echo"<H1>$title</H1>";?>
            <H2>Auteur</H2>
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
