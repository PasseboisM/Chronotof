<?php
if (!isset($cookieValide) && !isset($sessionValide)){
    header('Location: index.php');
}

require_once ('classes/class.Membres.php');
require_once ('classes/class.Photo.php');

$sql = '
SELECT *
FROM photo, publie
WHERE photo.id_photo = publie.id_photo
AND publie.id_utilisateur ='.$_SESSION['idUtilisateur']
;

$requete = $bdd->prepare($sql);
$listePublication = array();

if ($requete->execute()) {
    while ($donnee = $requete->fetch()) {
        $publication = new Publie(
            $donnee['id_photo'], null, null, $donnee['moyen_note'], $donnee['lien_photo'], $donnee['date_pub']
        );
        $membre = new Membres(
            $donnee['id_utilisateur'], null, null, null, null, null, null, null, null
        );
        $requete2 = $bdd->query('SELECT region.id_region, region.nom_region FROM region, photo WHERE region.id_region ='.$donnee['id_region']);
        $donnee1 = $requete2->fetch();
        $region = new Region(
            $donnee1['id_region'], $donnee1['nom_region']
        );
        $publication->setLaRegion($region);
        $publication->setLesMembres($membre);
        $listePublication[] = $publication;
    }
}

if (isset($_POST['suppr'])){
    for($i=0; $i<count($listePublication); $i++){
        $t = $listePublication[$i]->getId();
        if (isset($_POST[$t])){
            $bdd->exec('DELETE FROM note WHERE id_photo='.$listePublication[$i]->getId());
            $bdd->exec('DELETE FROM publie WHERE id_photo='.$listePublication[$i]->getId());
            $sql = $bdd->exec('DELETE FROM photo WHERE id_photo='.$listePublication[$i]->getId());
        }
    }
    header('Location: index.php?page=galerie');
    exit();
}

if ((isset($_FILES['image'])) AND ($_FILES['image']['error'] == 0) && isset($_POST['region'])) {

    // Extension autorisée

    $infosfichier = pathinfo($_FILES['image']['name']);

    $extension_upload = $infosfichier['extension'];

    $extensions_autorisees = array('jpg', 'jpeg', 'gif', 'png');

    $departement = $bdd->query('SELECT nom_region FROM region WHERE id_region='.$_POST['region'])->fetch()[0];
    if (in_array($extension_upload, $extensions_autorisees)) {

        // stokage

        $lienServeur = 'images_frise/'.$departement.'/_'. $_SESSION['idUtilisateur'] . '_' . basename($_FILES['image']['name']);
        $lienBDD = '_'. $_SESSION['idUtilisateur'] . '_' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $lienServeur);
        $ajoutLien = $bdd->prepare('INSERT INTO photo(lien_photo, id_region) VALUES (:lienPhoto, :idRegion)');
        $ajoutLien->execute(array(
            'lienPhoto' => $lienBDD,
            'idRegion' => $_POST['region']
        ));
        $idPhoto = $bdd->query('SELECT MAX(id_photo) FROM photo')->fetch()[0];
        $ajoutPublication = $bdd->exec('INSERT INTO publie VALUES (CURDATE(), '.$_SESSION['idUtilisateur'].','.$idPhoto.')');
        $ajoutLien->closeCursor();
        header('Location: index.php?page=galerie');
        exit();
    }
}
//Pour l'insertion penser à remplir la table publie et photo ainsi que la variable $mofifValide

/*echo '<pre>';
print_r($listePublication);
echo '</pre>';*/