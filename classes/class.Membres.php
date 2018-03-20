<?php
require_once('class.Commente.php');
require_once('class.Note.php');
require_once('class.Publie.php');

class Membres
{
    private $id = 0;
    private $nom = null;
    private $prenom = null;
    private $email = null;
    private $pseudo = null;
    private $mdp = null;
    private $age = 0;
    private $photo = null;
    private $date = null;

    private $lesPublications = array();
    private $lesNotes = array();
    private $commentent = array();

    //Constructeur

    public function Membres($id = 0, $nom = null, $prenom = null, $email = null, $pseudo = null, $mdp = null, $age = 0, $photo = null, $date = null) {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->pseudo = $pseudo;
        $this->mdp = $mdp;
        $this->age = $age;
        $this->photo = $photo;
        $this->date = $date;
    }

    //Getters

    public function getId() {return $this->id;}
    public function getNom() {return $this->nom;}
    public function getPrenom() {return $this->prenom;}
    public function getEmail() {return $this->email;}
    public function getPseudo() {return $this->pseudo;}
    public function getMdp() {return $this->mdp;}
    public function getAge() {return $this->age;}
    public function getPhoto() {return $this->photo;}
    public function getDate() {return $this->date;}
    public function getLesPublications() {return $this->lesPublications;}
    public function getLesNotes() {return $this->lesNotes;}
    public function getCommentent() {return $this->commentent;}

    //Setters

    public function setId($id) {$this->id = $id;}
    public function setNom($nom) {$this->nom = $nom;}
    public function setPrenom($prenom) {$this->prenom = $prenom;}
    public function setEmail($email) {$this->email = $email;}
    public function setPseudo($pseudo) {$this->pseudo = $pseudo;}
    public function setMdp($mdp) {$this->mdp = $mdp;}
    public function setAge($age) {$this->age = $age;}
    public function setPhoto($photo) {$this->photo = $photo;}
    public function setDate($date) {$this->date = $date;}
    public function setLesPublications($lesPublications) {$this->lesPublications = $lesPublications;}
    public function setLesNotes($lesNotes) {$this->lesNotes = $lesNotes;}
    public function setCommentent($commentent) {$this->commentent = $commentent;}
}

?>