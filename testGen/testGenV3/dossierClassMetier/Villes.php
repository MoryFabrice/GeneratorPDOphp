<?php
class Villes
{
  private $cp;
  private $id_pays;
  private $nom_ville;
  private $photo;
  private $site;
public function __construct($cp,$id_pays,$nom_ville,$photo,$site)
{
  $this->cp = $cp;
  $this->id_pays = $id_pays;
  $this->nom_ville = $nom_ville;
  $this->photo = $photo;
  $this->site = $site;
}
  public function getCp()
    {
        return $this->cp;
    }

    public function setCp($cp)
    {
        $this->cp = $cp;
    }
  public function getId_pays()
    {
        return $this->id_pays;
    }

    public function setId_pays($id_pays)
    {
        $this->id_pays = $id_pays;
    }
  public function getNom_ville()
    {
        return $this->nom_ville;
    }

    public function setNom_ville($nom_ville)
    {
        $this->nom_ville = $nom_ville;
    }
  public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }
  public function getSite()
    {
        return $this->site;
    }

    public function setSite($site)
    {
        $this->site = $site;
    }
}
    ?>