<?php
class Oeuvre
{
  //Atributs
  private $m_IdOeuvre;
  private $m_AlbumImg;
  private $m_TitreOeuvre;
  private $m_Prix;
  //Constructeur 
  public function __construct($p_IdOeuvre, $p_AlbumImg, $p_TitreOeuvre, $p_Prix)
  {
    $this->setIdOeuvre($p_IdOeuvre);
    $this->setAlbumImg($p_AlbumImg);
    $this->setTitreOeuvre($p_TitreOeuvre);
    $this->setPrix($p_Prix);
  }
  // getter/setter
  public function getIdOeuvre()
  {
    return $this->m_IdOeuvre;
  }
  public function setIdOeuvre($p_idOeuvre)
  {
    $this->m_IdOeuvre = $p_idOeuvre;
  }

  public function getAlbumImg()
  {
    return $this->m_AlbumImg;
  }
  public function setAlbumImg($p_AlbumImg)
  {
    $this->m_AlbumImg = $p_AlbumImg;
  }

  public function getTitreOeuvre()
  {
    return $this->m_TitreOeuvre;
  }
  public function setTitreOeuvre($p_TitreOeuvre)
  {
    $this->m_TitreOeuvre = $p_TitreOeuvre;
  }

  public function getPrix()
  {
    return $this->m_Prix;
  }
  public function setPrix($p_Prix)
  {
    $this->m_Prix = $p_Prix;
  }


  //Methodes  
  public function __toString()
  {
    return $this->m_IdOeuvre . " " . $this->m_TitreOeuvre . " " . $this->m_Prix;
  }
}
