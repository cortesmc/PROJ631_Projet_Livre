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
    <h1>Le nom du genre</h1>
	<div class="galerie">
        <?php   
            for ($i = 0; $i < 39; $i++){
                echo "<div class='item'>
                        <div>
                        <a href='?page=livre'>
                            <img src='livre.jpg' alt='Votre image'>
                        </a>
                        </div>
                        <div class='overlay'>
                            <a href='?page=livre'></a>
                            <p class='titre'>Harry Potter à l'école des sorciers</p>
                        </div>
                </div>";
            }
        ?> 
	</div>
</body>
</html>
