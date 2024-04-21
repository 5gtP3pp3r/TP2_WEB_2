<?php
class Oeuvre
{
  //Atributs
  private $m_IdOeuvre;
  private $m_CodeAlbum;
  private $m_TitreOeuvre;
  private $m_Prix;
  //Constructeur 
  public function __construct($p_IdOeuvre, $p_CodeAlbum, $p_TitreOeuvre, $p_Prix)
  {
    $this->setIdOeuvre($p_IdOeuvre);
    $this->setCodeAlbum($p_CodeAlbum);
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

  public function getCodeAlbum()
  {
    return $this->m_CodeAlbum;
  }
  public function setCodeAlbum($p_CodeAlbum)
  {
    $this->m_CodeAlbum = $p_CodeAlbum;
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
    return $this->m_CodeAlbum . " " . $this->m_TitreOeuvre . " " . $this->m_Prix;
  }
}
