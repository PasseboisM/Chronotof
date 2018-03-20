<?php
require_once('class.Photo.php');
require_once('class.Region.php');

class Region
{
    private $id = 0;
    private $nom = null;

    private $lesPhotos = array();

    //Constructeur

    public function Region($id = 0, $nom = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    //Getters

    public function getId() {return $this->id;}
    public function getNom() {return $this->nom;}
    public function getLesPhotos() {return $this->lesPhotos;}

    //Setters

    public function setId($id) {$this->id = $id;}
    public function setNom($nom) {$this->nom = $nom;}
    public function setLesPhotos($lesPhotos) {$this->lesPhotos = $lesPhotos;}

}

?>