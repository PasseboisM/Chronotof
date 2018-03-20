<?php
if (isset($cookieValide) || isset($sessionValide)){
    header('location: index.php?page=profil');
}

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {
    $pseudoR = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo AND mdp = :mdp');
    $pseudoR->execute(array(
        'pseudo' => htmlspecialchars($_POST['pseudo']),
        'mdp' => sha1(htmlspecialchars($_POST['mdp']))
    ));
    $pseudoV = $pseudoR->fetch()['pseudo'];
    if (!$pseudoV) {
        $verife = true;
        $pseudoR->closeCursor();
    } else {
        $_SESSION['mdp'] = sha1(htmlspecialchars($_POST['mdp']));
        $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
        if (isset($_POST['connect'])) {
            setcookie('pseudo', htmlspecialchars($_POST['pseudo']), time() + 1814400/*3semaines*/, null, null, false, true);
            setcookie('mdp', sha1(htmlspecialchars($_POST['mdp'])), time() + 1814400/*3semaines*/, null, null, false, true);
        }
        $pseudoR->closeCursor();
        header('Location: index.php?page=profil');
    }
}