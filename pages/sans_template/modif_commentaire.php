<?php
if (isset($_POST['commentaire']) && isset($_POST['idPhoto'])) {
    if ($_POST['commentaire']) {
        $sql = 'INSERT INTO commente VALUES (:commentaire, :photo, :utilisateur)';
        $requete = $bdd->prepare($sql);
        $requete->execute(array(
            'commentaire' => htmlspecialchars($_POST['commentaire']),
            'photo' => $_POST['idPhoto'],
            'utilisateur' => $_SESSION['idUtilisateur']
        ));
    }
}

if (isset($_POST['modifCom']) && isset($_POST['idPhoto'])){
    if ($_POST['modifCom']) {
        $sql = 'UPDATE commente SET commentaire =:commentaire WHERE id_photo =:photo AND id_utilisateur =:utilisateur';
        $requete = $bdd->prepare($sql);
        $requete->execute(array(
            'commentaire' => htmlspecialchars($_POST['modifCom']),
            'photo' => $_POST['idPhoto'],
            'utilisateur' => $_SESSION['idUtilisateur']
        ));
    }
}

if (isset($_POST['supprime']) && isset($_POST['idPhoto'])){
    $sql = 'DELETE FROM commente WHERE id_photo =:photo AND id_utilisateur =:utilisateur';
    $requete = $bdd->prepare($sql);
    $requete->execute(array(
        'photo' => $_POST['idPhoto'],
        'utilisateur' => $_SESSION['idUtilisateur']
    ));
}

if (isset($_POST['idPhoto'])) {
    header('Location: index.php?page=frise&id=' . $_POST['idPhoto']);
    exit();
} else {
    header('Location: index.php');
    exit();
}