<?php
require_once('class.Membres.php');
require_once('class.Photo.php');

class Commente extends Photo {
    private $commentaire = null;
    private $lienUtilisateur=0;

    private $lesMembres = array();

    //Constructeurs

    public function Commente($id=0, $latiude=0, $longitude=0, $moyenNote=0, $lienPhoto=null, $commentaire=null, $lienUtilisateur=0){
        parent::__construct($id, $latiude, $longitude, $moyenNote, $lienPhoto);
        $this->commentaire = $commentaire;
        $this->lienUtilisateur =$lienUtilisateur;
    }

    //Getters

    public function getCommentaire() {return $this->commentaire;}
    public function getLesMembres() {return $this->lesMembres;}
    public function getLienUtilisateur(){return $this->lienUtilisateur;}

    //Setters

    public function setCommentaire($commentaire) {$this->commentaire = $commentaire;}
    public function setLesMembres($lesMembres) {$this->lesMembres = $lesMembres;}
    public function setLienUtilisateur($lienUtilisateur){$this->lienUtilisateur = $lienUtilisateur;}
}

?>