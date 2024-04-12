<?php

class Client
{
    #region Const
    public $patternAlphaOnly = '/^[A-Za-z]{2,20}$/';

    #endregion

    #region Attributs

    private $nom;
    private $prenom;
    private $noCivique;
    private $rue;
    private $direction;
    private $apt;
    private $ville;
    private $province;
    private $codePostal;
    private $tel;
    private $courriel;
    private $nomUtilisateur;
    private $motDePasse;
    private $dateNaissance;
    private $dateInscription;
    private $dateDerniereConnexion;
    private $nbConnexions;
    #endregion

    #region Getters et Setters

    public function getNom()
    {
        if (preg_match($this->patternAlphaOnly, $this->nom)) {
            return $this->nom;
        } else {
            throw new Exception("Le nom doit contenir entre 2 et 20 lettres.");
        }
    }

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function getNoCivique()
    {
        return $this->noCivique;
    }

    public function getRue()
    {
        return $this->rue;
    }

    public function getDirection()
    {
        return $this->direction;
    }

    public function getApt()
    {
        return $this->apt;
    }

    public function getVille()
    {
        return $this->ville;
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function getCodePostal()
    {
        return $this->codePostal;
    }

    public function getTel()
    {
        return $this->tel;
    }

    public function getCourriel()
    {
        return $this->courriel;
    }

    public function getNomUtilisateur()
    {
        return $this->nomUtilisateur;
    }

    public function getMotDePasse()
    {
        return $this->motDePasse;
    }

    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    public function getDateDerniereConnexion()
    {
        return $this->dateDerniereConnexion;
    }

    public function getNbConnexions()
    {
        return $this->nbConnexions;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    public function setNoCivique($noCivique)
    {
        $this->noCivique = $noCivique;
    }

    public function setRue($rue)
    {
        $this->rue = $rue;
    }

    public function setDirection($direction)
    {
        $this->direction = $direction;
    }

    public function setApt($apt)
    {
        $this->apt = $apt;
    }

    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    public function setProvince($province)
    {
        $this->province = $province;
    }

    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;
    }

    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    public function setCourriel($courriel)
    {
        $this->courriel = $courriel;
    }

    public function setNomUtilisateur($nomUtilisateur)
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    public function setMotDePasse($motDePasse)
    {
        $this->motDePasse = $motDePasse;
    }

    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;
    }

    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }

    public function setDateDerniereConnexion($dateDerniereConnexion)
    {
        $this->dateDerniereConnexion = $dateDerniereConnexion;
    }

    public function setNbConnexions($nbConnexions)
    {
        $this->nbConnexions = $nbConnexions;
    }
    #endregion


    #region Constructeur

    public function __construct($nom, $prenom, $noCivique, $rue, $direction, $apt, $ville, $province, $codePostal, $tel, $courriel, $nomUtilisateur, $motDePasse, $dateNaissance, $dateInscription, $dateDerniereConnexion, $nbConnexions)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->noCivique = $noCivique;
        $this->rue = $rue;
        $this->direction = $direction;
        $this->apt = $apt;
        $this->ville = $ville;
        $this->province = $province;
        $this->codePostal = $codePostal;
        $this->tel = $tel;
        $this->courriel = $courriel;
        $this->nomUtilisateur = $nomUtilisateur;
        $this->motDePasse = $motDePasse;
        $this->dateNaissance = $dateNaissance;
        $this->dateInscription = $dateInscription;
        $this->dateDerniereConnexion = $dateDerniereConnexion;
        $this->nbConnexions = $nbConnexions;
    }
    #endregion

}
