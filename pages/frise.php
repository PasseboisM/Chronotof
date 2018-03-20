<?php
if (!isset($cookieValide) && !isset($sessionValide)) {
    $modeInvite = true;
}

require_once 'classes/class.Commente.php';
require_once 'classes/class.Note.php';

$sql = "
SELECT p.*, c.*
FROM commente c
INNER JOIN photo p
ON p.id_photo = c.id_photo
ORDER BY c.id_utilisateur";

$requete = $bdd->prepare($sql);

$liste = array();

if ($requete->execute()) {
    while ($donnees = $requete->fetch()) {

        /*echo '<pre>';
        print_r($donnees);
        echo '</pre>';*/

        $commentaire = new Commente(
            $donnees['id_photo'],
            $donnees['latitude'],
            $donnees['longitude'],
            $donnees['moyen_note'],
            $donnees['lien_photo'],
            $donnees['commentaire'],
            $donnees['id_utilisateur']
        );

        //ajout du membre

        $sql = "SELECT m.*, c.id_utilisateur
                FROM commente c
                INNER JOIN membres m
                ON m.id_utilisateur = c.id_utilisateur
                ORDER BY c.id_utilisateur";

        $requete2 = $bdd->prepare($sql);
        $listeMembres = array();
        if ($requete2->execute()) {

            while ($donnees2 = $requete2->fetch()) {

                /*echo '<pre>';
                print_r($donnees2);
                echo '</pre>';*/

                $membres = new Membres(
                    $donnees2['id_utilisateur'],
                    $donnees2['nom'],
                    $donnees2['prenom'],
                    $donnees2['email'],
                    $donnees2['pseudo'],
                    null,
                    $donnees2['age'],
                    $donnees2['photo'],
                    $donnees2['date_inscription']
                );
                $listeMembres[] = $membres;
            }
            $commentaire->setLesMembres($listeMembres);
        }
        $liste[] = $commentaire;
    }
}

//Region

$sql = "SELECT * FROM region";

$requete = $bdd->prepare($sql);
$listeRegion = array();
if ($requete->execute()) {
    while ($donnees = $requete->fetch()) {

        $region = new Region(
            $donnees['id_region'],
            $donnees['nom_region']
        );

        //ajout photos

        $sql = "SELECT p.*, r.id_region
                FROM photo p
                INNER JOIN region r
                ON p.id_region = r.id_region
                ";
        $requete2 = $bdd->prepare($sql);
        $listePhoto = array();
        if ($requete2->execute()) {

            while ($donnees2 = $requete2->fetch()) {

                $photo = new Photo(
                    $donnees2['id_photo'],
                    $donnees2['latitude'],
                    $donnees2['longitude'],
                    $donnees2['moyen_note'],
                    $donnees2['lien_photo']
                );

                $photo->setLaRegion($donnees2['id_region']);

                $listePhoto[] = $photo;
            }
            $region->setLesPhotos($listePhoto);
        }
        $listeRegion[] = $region;
    }
}


//Note

/*$sql = "
SELECT p.moyen_note, n.note
FROM note n
INNER JOIN photo p
ON p.id_photo = n.id_photo";

$requete = $bdd->prepare($sql);
$listeNote = array();
if ($requete->execute()){
    while ($donnees = $requete->fetch()){
        $note = new Note(
          null, null, null, $donnees['moyen_note'],null, $donnees['note']
        );
        $listeNote[] = $note;
    }
}*/

//préparation, création des variables

$nbImage = count($listePhoto);
$nbImageRegion = 0;
$nbRegion = count($listeRegion);

if (!isset($_SESSION['region'])) {
    $_SESSION['region'] = 'Bourgogne-Franche-Comte';
}

if (isset($_GET['region'])){
    $_SESSION['region'] = htmlspecialchars($_GET['region']);
}

for ($i = 0; $i < $nbRegion; $i++) {
    if ($_SESSION['region'] == $listeRegion[$i]->getNom()) {
        $laRegion = $listeRegion[$i];
    }
}

if (!isset($laRegion)){
    header('Location: morceaux/message.html');
}

if (!isset ($_GET['id'])) {
    for ($i=0; $i<count($laRegion->getLesPhotos()); $i++){
        if ($laRegion->getId() == $laRegion->getLesPhotos()[$i]->getLaRegion()){
            $_GET['id'] = $laRegion->getLesPhotos()[$i]->getId();
            break;
        }
    }
}

for ($t = 0; $t < $nbImage; $t++) {
    if ($laRegion->getId() == $laRegion->getLesPhotos()[$t]->getLaRegion()) {
        if ($_GET['id'] == $laRegion->getLesPhotos()[$t]->getId()) {
            $photoActuel = $laRegion->getLesPhotos()[$t]->getLienPhoto();
            $idPhotoActu = $laRegion->getLesPhotos()[$t]->getId();
        }
        $nbImageRegion = $nbImageRegion + 1;
        $photoRegion = $laRegion->getLesPhotos();
    }
}

$nomValide = explode("_",$laRegion->getNom());

if (!isset($_SESSION['idUtilisateur'])){
    $_SESSION['idUtilisateur'] = 0;
}

/*if (!isset($photoActuel)){
    header('Location: index.php?page=frise');
}*/
/*for ($i = 0; $i < count($liste); $i++) {
    echo $liste[$i]->getLienUtilisateur().' commentaire <br/>'; echo $listeMembres[$i]->getId().' membre<br/>';
}*/