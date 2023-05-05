<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="main_page.css" />
    <script src="https://kit.fontawesome.com/2556c3713e.js" crossorigin="anonymous"></script>
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

            echo "<div>";
            echo "<div><a href=\"?page=0\" class=\"btn_menu $encours[0]\">Titre</a></div>\n";
            echo "</div>";

            echo "<div>";
            echo "<div class='cliquable_avec_hover'><a href=\"?page=0\" class=\"btn_menu $encours[1]\">Home</a></div>\n";
            echo "<div class='cliquable_avec_hover'><a href=\"?page=1\" class=\"btn_menu $encours[2]\">Genres</a></div> \n";   
            echo "<div class='cliquable_avec_hover'><a href=\"?page=2\" class=\"btn_menu $encours[3]\">Biblio</a></div> \n";  
            echo "</div>";
            
            echo "<div>";
            echo "<div><form action='\"?page=3\"'>
                    <input type='text' value='Recherche'>
                    <button type='submit' name='submit'>
                        <i class='fa-sharp fa-light fa-magnifying-glass'></i>loupe
                    </button>
                    </form>
                    </div> \n"; 
            echo "</div>";
            
            echo "<div >";
            echo "<div class='cliquable_avec_hover'><a href=\"?page=4\" class=\"btn_menu $encours[5]\">Sign in</a></div> \n"; 
            echo "<div class='cliquable_avec_hover'><a href=\"?page=5\" class=\"btn_menu $encours[6]\">sign up</a></div> \n"; 
            echo "</div>";

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
  
  
  
