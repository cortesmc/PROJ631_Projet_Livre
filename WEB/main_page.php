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

<?php   
    $conn = @mysqli_connect("localhost", "root", "", "proj631_livres");    
    if (mysqli_connect_errno()) {
        $msg = "erreur ". mysqli_connect_error();
    } else {  
        $msg = "connecté au serveur " . mysqli_get_host_info($conn);
        mysqli_select_db($conn, "root");
        mysqli_query($conn, "SET NAMES UTF8");
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

            $sql = "SELECT libele FROM genre";
    
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

            echo "<div>";
                echo "<div><a href=\"?page=0\" class=\"btn_menu $encours[0]\">Titre</a></div>\n";
            echo "</div>";

            echo "<div>";
                echo "<div class='cliquable_avec_hover'><a href=\"?page=0\" class=\"btn_menu $encours[1]\">Home</a></div>\n";
                echo "<div class='cliquable_avec_hover'>
                        <a href=\"?page=1\" class=\"btn_menu $encours[2]\"  onclick='return false;'>Genres</a>
                        <div class='hover-box'>";
                        while ($row = mysqli_fetch_assoc($result)){
                            $genre=$row["libele"];
                            echo "<a href=\"?page=1&genre=$genre\" class='genres'>$genre</a>";
                        }
                        echo "</div>
                    </div> \n";   

                echo "<div class='cliquable_avec_hover'><a href=\"?page=2\" class=\"btn_menu $encours[3]\">Biblio</a></div> \n";  
            echo "</div>";
                
            echo "<div>";
                echo "<div><form action='\"?page=3\"'>
                        <input type='text' placeholder='Rechercher'>
                        <button type='submit' name='submit'>
                            <i class='fa-sharp fa-light fa-magnifying-glass'></i>esp
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
    
    <footer class="footer-distributed">
        <div class="footer-left">
            <p class="footer-links">
                <a class="link-1" href="?page=0">Home</a>
                <a href="?page=2">Bilio</a>
                <a href="?page=4">Sign in</a>
                <a href="?page=5">Sign out</a>
            </p>
            <p>PROJ631 2023</p>
        </div>
    </footer>
</body>
</html>  
  
  
  
