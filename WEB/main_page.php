<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if(isset($_GET['dark'])){
            if ($_GET['dark']=='true'){
                echo " <link rel='stylesheet' href='DarkMode/main_page_dark.css' />";
                $dark='true';
            }
            else{
                echo "<link rel='stylesheet' href='main_page.css' />";
                $dark='false';
            }
        }
        else {
            header('Location: main_page.php?dark=false');
            echo "<link rel='stylesheet' href='main_page.css' />";
            $dark='false';
        }
    ?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-GFDV7zEa6G8V7U5m6HF5BYBx/zIw2zE6yyTP3q4i4erFOlHz85Xzjq+NCO3Mq/gM"
        crossorigin="anonymous">
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

<?php
    if (isset($_POST['Ajouter'])){
        if (isset($_POST['username']) && isset($_POST['name']) && isset($_POST['prenom']) && isset($_POST['mdp'])) {
            // Code PHP pour insérer les données dans la base de données
            if (($_POST['username'] != null)&&($_POST['name'] != null)&&($_POST['prenom'] != null)&&($_POST['mdp'] != null)) {
                // Insérer les données dans la base de données
                $username = $_POST['username'];
                $name = $_POST['name'];
                $prenom = $_POST['prenom'];
                $mdp = $_POST['mdp'];
                // Code pour insérer les données dans la base de données ici
                $sql="SELECT * FROM utilisateur WHERE username=$username";
                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

                if (mysqli_num_rows($result) > 0){
                    $sql = "INSERT INTO utilisateur (username,lastname,firstname,password) VALUES ('$username','$name','$prenom','$mdp')";
                    
                    mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error($conn)."\n".$sql);
                    
                    // Génération de la chaîne de requête GET
                    $query_string = http_build_query(array('user' => $username));
    
                    // Redirection vers la nouvelle URL avec l'information en GET
                    header('Location: main_page.php?dark='.$dark.'&page=0&' . $query_string);
                    exit();
                }
                else{
                    header('Location: main_page.php?dark='.$dark.'&page=5&compte=erreur');
                }

            }
            else{
                header('Location: main_page.php?dark='.$dark.'&page=5&compte=erreur');
            }                
        }
    }
?>
<?php
    if (isset($_POST['Connexion'])){
        if (isset($_POST['username'])&&isset($_POST['mdp'])) {
            // Code PHP pour insérer les données dans la base de données
            if (($_POST['username'] != null)&&($_POST['mdp'] != null)) {
                // Insérer les données dans la base de données
                $username = $_POST['username'];
                $mdp = $_POST['mdp'];
                $dark=$_GET["dark"];
                // Code pour insérer les données dans la base de données ici

                $sql = "SELECT * FROM utilisateur WHERE username='$username' AND password='$mdp'";

                $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

                while ($row = mysqli_fetch_assoc($result)){
                    $user=$row["username"];
                    $pasword=$row["password"];
                }

                if (($user==null)&&($pasword==null)){
                    header('Location: main_page.php?dark='.$dark.'&page=4&compte=erreur');
                }
                else{
                    // Génération de la chaîne de requête GET
                    $query_string = http_build_query(array('user' => $user));

                    // Redirection vers la nouvelle URL avec l'information en GET
                    header('Location: main_page.php?dark='.$dark.'&page=0&' . $query_string);
                }
            }else{
                header('Location: main_page.php?dark='.$dark.'&page=4&compte=erreur');
            }                
        }
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

            if( !isset($_GET["dark"]) ) { 
                $dark="false";
            }else{
                $dark=$_GET["dark"];
            }

            $encours[$page] = "encours";

            $sql = "SELECT libele FROM genre";
    
            $result = mysqli_query($conn, $sql) or die("Requête invalide: ". mysqli_error()."\n".$sql);

            if (isset($_GET['user'])){
                $user=$_GET['user'];
                echo "<div>";
                echo "<div><a href=\"?dark=$dark&page=0&user=$user\" class=\"btn_menu $encours[0]\">B.A.R</a></div>\n";
            echo "</div>";

            echo "<div>";
                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=0&user=$user\" class=\"btn_menu $encours[1]\">Home</a></div>\n";
                echo "<div class='cliquable_avec_hover'>
                        <a href=\"?dark=$dark&page=1&user=$user\" class=\"btn_menu $encours[2]\"  onclick='return false;'>Genres</a>
                        <div class='hover-box'>";
                        while ($row = mysqli_fetch_assoc($result)){
                            $genre=$row["libele"];
                            echo "<a href=\"?dark=$dark&page=1&user=$user&genre=$genre\" class='genres'>$genre</a>";
                        }
                        echo "</div>
                    </div> \n";   

                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=2&user=$user\" class=\"btn_menu $encours[3]\">Biblio</a></div> \n";  
                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=amis&user=$user&amis=home\" class=\"btn_menu $encours[3]\">Amis</a></div> \n";  
            echo "</div>";
                
            echo "<div>";
                echo "
                        <form method='POST' action='?dark=$dark&page=3&user=$user' class='form_recherche'>
                            <div class='recherche'>
                            <input type='text' name='search' placeholder='Rechercher...' class='recherche'>
                                <button type='submit'>
                                <i class='fa fa-search'></i>
                                </button>
                            </div>
                        </form>"; 
            echo "</div>";
                
            echo "<div >";
                    echo "<div><a href=\"?dark=$dark&page=6&user=$user\" class=\"btn_menu $encours[5]\" onclick='return false;'>$user</a></div> \n";
                if ($_GET['dark']=="false"){
                    // Récupérer la chaîne de requête de l'URL actuelle
                    $queryString = $_SERVER['QUERY_STRING'];
                    parse_str($queryString, $params);
                    $params['dark'] = 'true';
                    $newQueryString = http_build_query($params);
                    echo "<div><a href=\"?$newQueryString\" class=\"btn_menu $encours[5]\" >◐</a></div> \n";
                }
                else{
                    // Récupérer la chaîne de requête de l'URL actuelle
                    $queryString = $_SERVER['QUERY_STRING'];
                    parse_str($queryString, $params);
                    $params['dark'] = 'false';
                    $newQueryString = http_build_query($params);
                    echo "<div><a href=\"?$newQueryString\" class=\"btn_menu $encours[5]\" >◑</a></div> \n";
                }
            echo "</div>";
            }

            else{
                echo "<div>";
                echo "<div><a href=\"?dark=$dark&page=0\" class=\"btn_menu $encours[0]\">B.A.R</a></div>\n";
            echo "</div>";

            echo "<div>";
                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=0\" class=\"btn_menu $encours[1]\">Home</a></div>\n";
                echo "<div class='cliquable_avec_hover'>
                        <a href=\"?dark=$dark&page=1\" class=\"btn_menu $encours[2]\"  onclick='return false;'>Genres</a>
                        <div class='hover-box'>";
                        while ($row = mysqli_fetch_assoc($result)){
                            $genre=$row["libele"];
                            echo "<a href=\"?dark=$dark&page=1&genre=$genre\" class='genres'>$genre</a>";
                        }
                        echo "</div>
                    </div> \n";   

                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=4\" class=\"btn_menu $encours[3]\">Biblio</a></div> \n";  
                echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=4\" class=\"btn_menu $encours[3]\">Amis</a></div> \n";  
            echo "</div>";
                
            echo "<div>";
                echo "
                        <form method='post' action='?dark=$dark&page=3' class='form_recherche'>
                            <div style='position: relative;'>
                            <input type='text' name='search' placeholder='Rechercher...' class='recherche'>
                                <button type='submit' style='position: absolute; top: 50%; transform: translateY(-50%); right: 5px;'>
                                <i class='fa fa-search'></i>
                                </button>
                            </div>
                        </form>"; 
            echo "</div>";
                
            echo "<div >";
                    echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=4\" class=\"btn_menu $encours[5]\">Sign in</a></div> \n"; 
                    echo "<div class='cliquable_avec_hover'><a href=\"?dark=$dark&page=5\" class=\"btn_menu $encours[6]\">Sign up</a></div> \n"; 
                    if ($_GET['dark']=="false"){
                        // Récupérer la chaîne de requête de l'URL actuelle
                        $queryString = $_SERVER['QUERY_STRING'];
                        parse_str($queryString, $params);
                        $params['dark'] = 'true';
                        $newQueryString = http_build_query($params);
                        echo "<div><a href=\"?$newQueryString\" class=\"btn_menu $encours[5]\" >◐</a></div> \n";
                    }
                    else{
                        // Récupérer la chaîne de requête de l'URL actuelle
                        $queryString = $_SERVER['QUERY_STRING'];
                        parse_str($queryString, $params);
                        $params['dark'] = 'false';
                        $newQueryString = http_build_query($params);
                        echo "<div><a href=\"?$newQueryString\" class=\"btn_menu $encours[5]\" >◑</a></div> \n";
                    }
            echo "</div>";
            
            }

            ?>
        </div>
    </header>
    <div class='principal'>
        <?php
            if( file_exists("page_".$page.".php") ){ 
                include("page_".$page.".php");
            }
        ?>
    </div>
    
    <footer class="footer-distributed">
        <div class="footer-left">
            <p class="footer-links">
                <?php
                if (isset($_GET["user"])){
                    $user=$_GET["user"];
                    echo"<a class='link-1' href='?dark=$dark&page=0&user=$user'>Home</a>";
                    echo"<a href='?dark=$dark&page=2&user=$user'>Biblio</a>";
                    echo"<a href='?dark=$dark&page=6&user=$user'>$user</a>";
                }else{
                    echo"<a class='link-1' href='?dark=$dark&page=0'>Home</a>";
                    echo"<a href='?dark=$dark&page=2'>Bilio</a>";
                    echo"<a href='?dark=$dark&page=4'>Sign in</a>";
                    echo"<a href='?dark=$dark&page=5'>Sign out</a>";
                }
                ?>
            </p>
            <p>PROJ631 2023</p>
        </div>
    </footer>
</body>
</html>  
  
  
  
