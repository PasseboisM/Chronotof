<?php
if (isset($_POST['region'])){
    $requete = $bdd->query('SELECT nom_region FROM region WHERE id_region='.$_POST['region'])->fetch()[0];
    $_SESSION['region'] = $requete;
    header('Location: index.php?page=frise');
}