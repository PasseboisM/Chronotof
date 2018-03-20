<?php

$sql = 'INSERT INTO note VALUES (:note, :utilisateur, :photo)';
$requete1 = $bdd->prepare($sql);

if (isset($_POST['vote']) && isset($_POST['idPhoto'])) {
    $note = $_POST['vote'];
    switch ($note) {
        case 1:
            $requete1->execute(array(
                'note' => 1,
                'utilisateur' => $_SESSION['idUtilisateur'],
                'photo' => $_POST['idPhoto']
            ));
            $_SESSION['vote'] = 1;
            break;

        case 2:
            $requete1->execute(array(
                'note' => 2,
                'utilisateur' => $_SESSION['idUtilisateur'],
                'photo' => $_POST['idPhoto']
            ));
            $_SESSION['vote'] = 2;
            break;

        case 3:
            $requete1->execute(array(
                'note' => 3,
                'utilisateur' => $_SESSION['idUtilisateur'],
                'photo' => $_POST['idPhoto']
            ));
            $_SESSION['vote'] = 3;
            break;

        case 4:
            $requete1->execute(array(
                'note' => 4,
                'utilisateur' => $_SESSION['idUtilisateur'],
                'photo' => $_POST['idPhoto']
            ));
            $_SESSION['vote'] = 4;
            break;

        case 5:
            $requete1->execute(array(
                'note' => 5,
                'utilisateur' => $_SESSION['idUtilisateur'],
                'photo' => $_POST['idPhoto']
            ));
            $_SESSION['vote'] = 5;
            break;
    }
    $moyenPhoto = $bdd->query('SELECT AVG(note) FROM note WHERE id_photo=' . $_POST['idPhoto'])->fetch();
    $ajoutMoyenNote = $bdd->exec('UPDATE photo SET moyen_note=' . $moyenPhoto[0] . ' WHERE id_photo=' . $_POST['idPhoto']);
}

if (isset($_POST['idPhoto'])) {
    header('Location: index.php?page=frise&id=' . $_POST['idPhoto']);
} else {
    header('Location: index.php');
}