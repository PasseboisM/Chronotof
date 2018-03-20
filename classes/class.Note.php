<?php
require_once('class.Membres.php');
require_once('class.Photo.php');

class Note extends Photo
{
    private $note = 0;

    private $lesMembres;

    //Constructeurs

    public function Note($id = 0, $latiude = 0, $longitude = 0, $moyenNote = 0, $lienPhoto=null, $note = 0){
        parent::__construct($id, $latiude, $longitude, $moyenNote, $lienPhoto);
        $this->note = $note;
    }

    //Getters

    public function getNote() {return $this->note;}
    public function getLesMembres() {return $this->lesMembres;}

    //Setters

    public function setNote($note) {$this->note = $note;}
    public function setLesMembres($lesMembres) {$this->lesMembres = $lesMembres;}
}

?>