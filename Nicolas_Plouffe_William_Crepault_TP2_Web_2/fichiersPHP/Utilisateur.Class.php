<?php
class Oeuvre
{
  //Atributs
  private $m_Id;
  private $m_Nom;
  private $m_Email;
  private $m_MotPasse;
  Private $m_Ville;
  private $m_Role;
  private $m_Age;
  //Constructeur 
  public function __construct($p_Id, $p_Nom, $p_Email, $p_MotPasse, $p_Ville, $p_Role, $p_Age)
  {
    $this->setId($p_Id);
    $this->setNom($p_Nom);
    $this->setEmail($p_Email);
    $this->setMotPasse($p_MotPasse);
    $this->setVille($p_Ville);
    $this->setRole($p_Role);
    $this->setAge($p_Age);
  }
  // getter/setter
  public function getId()
  {
    return $this->m_Id;
  }
  public function setId($p_Id)
  {
    $this->m_Id = $p_Id;
  }

  public function getNom()
  {
    return $this->m_Nom;
  }
  public function setNom($p_Nom)
  {
    $this->m_Nom = $p_Nom;
  }

  public function getEmail()
  {
    return $this->m_Email;
  }
  public function setEmail($p_Email)
  {
    $this->m_Email = $p_Email;
  }

  public function getMotPasse()
  {
    return $this->m_MotPasse;
  }
  public function setMotPasse($p_MotPasse)
  {
    $this->m_MotPasse = $p_MotPasse;
  }

  public function getVille()
  {
    return $this->m_Ville;
  }
  public function setVille($p_Ville)
  {
    $this->m_Ville = $p_Ville;
  }

  public function getRole()
  {
    return $this->m_Role;
  }
  public function setRole($p_Role)
  {
    $this->m_Role = $p_Role;
  }

  public function getAge()
  {
    return $this->m_Age;
  }
  public function setAge($p_Age)
  {
    $this->m_Age = $p_Age;
  }

  //Methodes  
  public function __toString()
  {
    return $this->m_CodeAlbum . " " . $this->m_TitreOeuvre . " " . $this->m_Prix;
  }
}