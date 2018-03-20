<?php
require_once('class.Membres.php');
require_once('class.Photo.php');

class Publie extends Photo
{
    private $date = null;

    private $lesMembres;

    //Constructeurs

    public function Publie($id = 0, $latiude = 0, $longitude = 0, $moyenNote = 0, $lienPhoto=null, $date = null){
        parent::__construct($id, $latiude, $longitude, $moyenNote, $lienPhoto);
        $this->date = $date;
    }

    //Getters

    public function getDate() {return $this->date;}
    public function getLesMembres() {return $this->lesMembres;}

    //Setters

    public function setDate($date) {$this->date = $date;}
    public function setLesMembres($lesMembres) {$this->lesMembres = $lesMembres;}
}
?>