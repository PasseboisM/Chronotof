<?php
if (isset($_COOKIE['pseudo']) && isset($_COOKIE['mdp']) || isset($_SESSION['pseudo']) && isset($_SESSION['mdp'])) {
    if (isset($_COOKIE['pseudo']) && isset($_COOKIE['mdp'])) {
        $verifeC = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo AND mdp = :mdp');
        $verifeC->execute(array(
            'pseudo' => $_COOKIE['pseudo'],
            'mdp' => $_COOKIE['mdp']
        ));
        if ($verifeC->fetch()['pseudo']) {
            $cookieValide = true;
            $verifeC->closeCursor();
        } else{
        }
        $verifeC->closeCursor();
    } else {
        $verifeS = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo AND mdp = :mdp');
        $verifeS->execute(array(
            'pseudo' => $_SESSION['pseudo'],
            'mdp' => $_SESSION['mdp']
        ));
        if ($verifeS->fetch()['pseudo']) {
            $sessionValide = true;
            $verifeS->closeCursor();
        }
        $verifeS->closeCursor();
    }
}