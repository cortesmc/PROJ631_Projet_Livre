<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_page.css" />
    <title>Document</title>
</head>

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
            echo "<div><form action='\"?page=4\"'><input type='text'></form></div> \n"; 
            echo "<div><a href=\"?page=5\" class=\"btn_menu $encours[5]\">Sign in</a></div> \n"; 
            echo "<div><a href=\"?page=6\" class=\"btn_menu $encours[6]\">sign up</a></div> \n"; 
            ?>
        </div>
    
    </header>
    <div>
        <?php
            if( file_exists("page_".$page.".php") ){ 
                include("page_".$page.".php");
            }
        ?>
    </div>
</body>
</html>  
  
  
  
