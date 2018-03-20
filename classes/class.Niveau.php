<?php

class Niveau
{
    private $id = 0;
    private $points = 0;
    private $lib = null;
    private $description = null;

    //Constructeur

    public function Niveau($id = 0, $points = 0, $lib = null, $description = null){
        $this->id = $id;
        $this->points = $points;
        $this->lib = $lib;
        $this->description = $description;
    }

    //Getters

    public function getId() {return $this->id;}
    public function getPoints() {return $this->points;}
    public function getLib() {return $this->lib;}
    public function getDescription() {return $this->description;}

    //Setters

    public function setId($id) {$this->id = $id;}
    public function setPoints($points) {$this->points = $points;}
    public function setLib($lib) {$this->lib = $lib;}
    public function setDescription($description) {$this->description = $description;}
}
?>