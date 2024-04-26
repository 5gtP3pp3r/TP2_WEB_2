<?php

$codePattern = '/[A-Z]{3}\d{4}/';
$DurePattern = '/^\d+$/';

$MAX_VALUE = 10;
$MIN_VALUE = 0.00;
$VALUE_ZERO = 0;


// Validation des champs

//Validation du champ Pièce
function validerChampsPiece()
{
    $estNonValide = false;
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";


    if (empty($_POST[' ']) || !preg_match($regexNom, $_POST['pieceName'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}


//Validation du champ Artiste
function validerChampsArtiste()
{

    $estNonValide = false;
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";

    if (empty($_POST['artistName']) || !preg_match($regexNom, $_POST['artistName'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Rôle

function validerChampsRole()
{
    $estNonValide = false;

    if ($_POST['role'] == '$VALUE_ZERO') {
        return $estNonValide;
    }
    return $estNonValide = true;
}


//Validation du champ Temps
function validerChampsTemps()
{
    $estNonValide = false;
    $sizeMBPattern = '/[0-9]{1,4}/';

    if (empty($_POST['timeInSec']) || !preg_match($sizeMBPattern, $_POST['timeInSec'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Taille
function validerChampsTaille()
{
    $estNonValide = false;
    $regexTaille = '/[0-9]{1,4}/';

    if (empty($_POST['sizeMB']) || !preg_match($regexTaille, $_POST['sizeMB'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}
//Validation du champ Valeur
function validerChampsValeur()
{
    $estNonValide = false;
    $regexValeur = '/[0-9]{1,4}/';
    $MAX_VALUE = 10;
    $MIN_VALUE = 0.00;
    if (empty($_POST['albumValue']) || $_POST['albumValue'] > $MAX_VALUE || $_POST['albumValue'] < $MIN_VALUE || !preg_match($regexValeur, $_POST['albumValue'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}


//Validation du champ Date
function validerChampsDate()
{
    $estNonValide = false;
    $regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';

    if (empty($_POST['datePublication']) || !preg_match($regexDate, $_POST['datePublication']) || $_POST['datePublication'] > date('Y-m-d')) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Code
function validerChampsCode()
{
    $estNonValide = false;
    $codePattern = '/[A-Z]{3}\d{4}/';

    if (empty($_POST['albumCode']) || !preg_match($codePattern, $_POST['albumCode'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Lien Youtube

function validerChampsLien()
{
    $estNonValide = false;
    $regexLien = '/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/';

    if (!preg_match($regexLien, $_POST['youtubeLink'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Lyrics

//Validation du champ Lyrics
function validerChampsLyrics()
{
    $estNonValide = false;
    $regexLyrics = filter_var($_POST['lyrics'], FILTER_SANITIZE_STRING);

    if (empty($_POST['lyrics']) || !preg_match($regexLyrics, $_POST['lyrics'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}


function injectionOeuvre()
{
    $conn = connexionBD();
    try {
        $sql = "INSERT INTO oeuvre (titre_oeuvre, dureesec, id_ville, taillemb, lyrics,date_ajout,prix) VALUES (:pieceName, :dureesec, :taillemb, :lyrics, :date_ajout, :prix)";

        $stmt = $conn->prepare($sql); // Préparation de la requête

        $stmt->bindParam(':nomArtiste', $_POST['pieceName']);
        $stmt->bindParam(':photoArtiste', $_POST['photoArtiste']);
        $stmt->bindParam(':ville', $_POST['ville']);

        $stmt->execute();
        $conn = null; // Fermeture de la connexion
    } catch (PDOException $e) {
        error_log("erreur ajout artiste: " . $e->getMessage());
        return false;
    }
}
