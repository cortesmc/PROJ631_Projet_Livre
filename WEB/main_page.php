<!-- <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <divnk rel="stylesheet" href="main_page.css" />
    <title>Document</title>
</head>
<body>
    <header>
        <div class="header_contents">
            <div>
                <a href="">Titre</a>
            </div>
            <div>
                <a href="">Home</a>
            </div>
            <div>
                <a href="">Genres</a>
            </div>
            <div>
                <a href="">Bibdivo</a>
            </div>
            <div>
                <form action="">
                    <input type="text">
                </form>
            </div>
            <div>
                <a href="">Sign in</a>
            </div>
            <div>
                <a href="">Sign up</a>
            </div>
        </div>
    </header>
</body>
</html> -->


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <divnk rel="stylesheet" href="main_page.css" />
    <title>Document</title>
</head>


<?php
    $conn = @mysqdiv_connect("tp-epua:3308", "femathie", "fq4q2vk2");
    if (mysqdiv_connect_errno()) {
        $msg = "erreur ". mysqdiv_connect_error();
    } 
    else {  
        $msg = "connecté au serveur " . mysqdiv_get_host_info($conn);
        mysqdiv_select_db($conn, "femathie");
        mysqdiv_query($conn, "SET NAMES UTF8");
    }
    
?> 

<body>
    <header id="fond">        
        <div id="menu">
            <?php  
            $encours = array(" "," "," "," "," "," "," ");

            if( !isset($_GET["page"]) ) { 
                $page=0;
            }else{
                $page=$_GET["page"];
            }
            $encours[$page] = "encours";
            
            echo "<div><a href=\"?page=0\" class=\"btn_menu $encours[0]\">Titre</a></div>\n";
            echo "<div><a href=\"?page=1\" class=\"btn_menu $encours[1]\">Home</a></div>\n";
            echo "<div><a href=\"?page=2\" class=\"btn_menu $encours[2]\">Genres</a></div> \n";   
            echo "<div><a href=\"?page=3\" class=\"btn_menu $encours[3]\">Biblio</a></div> \n";   
            echo "<div><a href=\"?page=4\" class=\"btn_menu $encours[4]\">Mesures</a></div> \n"; 
            echo "<div><a href=\"?page=4\" class=\"btn_menu $encours[5]\">Sign in</a></div> \n"; 
            echo "<div><a href=\"?page=4\" class=\"btn_menu $encours[6]\">sign up</a></div> \n"; 
            ?>
        </div>
    
    </header>
    <div>
        <?php
            if( file_exists("page_".$page.".inc.php") ){ 
                include("page_".$page.".inc.php");
            }
        ?>
    </div>
</body>
</html>  
  
  
  
