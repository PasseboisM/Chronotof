<?php
require_once('class.Region.php');

class Photo
{
    private $id = 0;
    private $latitude = 0;
    private $longitude = 0;
    private $moyenNote = 0;
    private $lienPhoto = null;

    private $laRegion = null;

    //Constructeurs

    public function Photo($id = 0, $latitude = 0, $longitude = 0, $moyenNote = 0, $lienPhoto=0){
        $this->id = $id;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->moyenNote =$moyenNote;
        $this->lienPhoto =$lienPhoto;
    }

    //Getters

    public function getId() {return $this->id;}
    public function getLatitude()
    {
        return $this->latitude;
    }
    public function getLongitude()
    {
        return $this->longitude;
    }
    public function getMoyenNote()
    {
        return $this->moyenNote;
    }
    public function getLienPhoto()
    {
        return $this->lienPhoto;
    }
    public function getLaRegion()
    {
        return $this->laRegion;
    }

    //Setters

    public function setId($id)
    {
        $this->id = $id;
    }
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }
    public function setMoyenNote($moyenNote)
    {
        $this->moyenNote = $moyenNote;
    }
    public function setLienPhoto($lienPhoto)
    {
        $this->lienPhoto = $lienPhoto;
    }
    public function setLaRegion($laRegion)
    {
        $this->laRegion = $laRegion;
    }
}

?>