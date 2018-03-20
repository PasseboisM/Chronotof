<?php
if (isset($_POST['suppr'])) {
    /*requete sql qui si elle existe supprime le lien photo de profil de la table membres*/
    $supprLien = $bdd->prepare('UPDATE membres SET photo = NULL WHERE id_utilisateur = :pseudo');
    $supprLien->execute(array(
        'pseudo' => $_SESSION['idUtilisateur']
    ));
    $supprLien->closeCursor();
    /*supprimer à l'aide de php photo sur le serveur ?*/
}

if (isset($_FILES['image']) AND $_FILES['image']['error'] == 0) {

    // Extension autorisée

    $infosfichier = pathinfo($_FILES['image']['name']);

    $extension_upload = $infosfichier['extension'];

    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

    if (in_array($extension_upload, $extensions_autorisees)) {

        // stokage

        $cheminImage = 'images_profils/_' . $_SESSION['idUtilisateur'] . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $cheminImage);
        $ajoutLien = $bdd->prepare('UPDATE membres SET photo = :lienPhoto WHERE id_utilisateur = :pseudo');
        $ajoutLien->execute(array(
            'lienPhoto' => $cheminImage,
            'pseudo' => $_SESSION['idUtilisateur']
        ));
        $ajoutLien->closeCursor();
    }
}
header('Location: index.php?page=profil');
exit();