<?php
session_start();
include 'connexion.php';
include 'verife.php';

$page = "";
$param = 0;
$titre = "";

// Si aucune page demandée => on prend l'accueil par défaut
if(!isset($_GET["page"])){
    $_GET["page"] = "accueil";
}

if(isset($_GET["page"])){
    // Ouverture du fichier des routes
    $routes = parse_ini_file("parametres/routes.ini", true);
    $page = $routes[$_GET["page"]]["page"];
    $template = $routes[$_GET["page"]]["template"];
    if(isset($routes[$_GET["page"]]["param"])){
        $param = $routes[$_GET["page"]]["param"];
    }
    if(isset($routes[$_GET["page"]]["titre"])){
        $titre = $routes[$_GET["page"]]["titre"];
    }

}

include('morceaux/head.html');
if($page != ""){include $page;}
include $template;
include('morceaux/footer.html'); include ('morceaux/menu.js');
?>
</body>
</html>

