<?php
if (isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['mdpV']) && isset($_POST['email']) && isset($_POST['age'])) {
    $vPseudo = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo = :pseudo');
    $vPseudo->execute(array(
        'pseudo' => $_POST['pseudo']
    ));
    $pseudoE = $vPseudo->fetch()['pseudo'];
    if ($_POST['mdp'] == $_POST['mdpV'] && !$pseudoE) {
        $_SESSION['mdp'] = sha1(htmlspecialchars($_POST['mdp']));
        $_SESSION['pseudo'] = htmlspecialchars($_POST['pseudo']);
        $_SESSION['email'] = htmlspecialchars($_POST['email']);
        $_SESSION['age'] = htmlspecialchars($_POST['age']);
        if (isset($_POST['connect'])) {
            setcookie('pseudo', htmlspecialchars($_POST['pseudo']), time() + 1814400/*3semaines*/, null, null, false, true);
            setcookie('mdp', sha1(htmlspecialchars($_POST['mdp'])), time() + 1814400/*3semaines*/, null, null, false, true);
        } else {
            setcookie('pseudo', '');
            setcookie('pass_hache', '');
        }
        $ajout = $bdd->prepare('INSERT INTO membres(pseudo, mdp, email, age, date_inscription) VALUES(:pseudo, :mdp, :email, :age, CURDATE())');
        $ajout->execute(array(
            'pseudo' => $_SESSION['pseudo'],
            'mdp' => $_SESSION['mdp'],
            'email' => $_SESSION['email'],
            'age' => $_POST['age']
        ));
        $ajout->closeCursor();
        header('Location: index.php?page=profil');
    }
}