<?php
require_once('classes/class.Membres.php');
require_once('classes/class.Photo.php');
require_once('classes/class.Niveau.php');

if (!isset($cookieValide) && !isset($sessionValide)) {
    header('Location: index.php');
}
if (isset($cookieValide)) {
    $pseudo = $_COOKIE['pseudo'];
} else {
    $pseudo = $_SESSION['pseudo'];
}

$idPseudo = $bdd->query('SELECT id_utilisateur FROM membres WHERE pseudo=\'' . $pseudo . '\'')->fetch()[0];
$_SESSION['idUtilisateur'] = $idPseudo;

$sql = '
SELECT *
FROM photo, publie
WHERE photo.id_photo = publie.id_photo
AND publie.id_utilisateur =' . $_SESSION['idUtilisateur'];

$requete = $bdd->prepare($sql);
$listePublication = array();

if ($requete->execute()) {
    while ($donnee = $requete->fetch()) {
        $publication = new Publie(
            null, null, null, $donnee['moyen_note'], $donnee['lien_photo'], $donnee['date_pub']
        );
        $membre = new Membres(
            $donnee['id_utilisateur'], null, null, null, null, null, null, null, null
        );
        $requete2 = $bdd->query('SELECT region.id_region, region.nom_region FROM region, photo WHERE region.id_region =' . $donnee['id_region']);
        $donnee1 = $requete2->fetch();
        $region = new Region(
            $donnee1['id_region'], $donnee1['nom_region']
        );
        $publication->setLaRegion($region);
        $publication->setLesMembres($membre);
        $listePublication[] = $publication;
    }
}
$sql = 'SELECT * FROM niveau';
$requete = $bdd->prepare($sql);
$listeNiveau = array();
if ($requete->execute()) {
    while ($donnee = $requete->fetch()) {
        $niveau = new Niveau(
            $donnee['id_niveau'],
            $donnee['points_mini'],
            $donnee['libelle_niveau'],
            $donnee['description_niveau']
        );
        $listeNiveau[] = $niveau;
    }
}

for ($i = 0; $i < count($listeNiveau); $i++) {
    if ($listeNiveau[$i]->getPoints() <= count($listePublication)) {
        $titrePhotographe = $listeNiveau[$i]->getLib();
        $descritionTitre = $listeNiveau[$i]->getDescription();
    }
}

if (!isset($titrePhotographe)) {
    $titrePhotographe = 'Débutant';
}

switch ($titrePhotographe) {
    case 'Débutant':
        $width = count($listePublication) * 1.7;
        break;

    case 'Apprenti photographe':
        $width = (count($listePublication)- 60) * 1.7;
        break;

    case 'Amateur talentueux':
        $width = (count($listePublication)- 120) * 1.7;
        break;

    case 'Baron de la photographie':
        $width = (count($listePublication)- 180) * 1.7;
        break;

    case 'Grand panoramix':
        $width = (count($listePublication)- 240) * 1.7;
        break;

    case 'Maestro de la photo':
        $width = (count($listePublication)- 300) * 1.7;
        break;
}

/*echo '<pre>';
print_r($listePublication);
echo '</pre>';*/