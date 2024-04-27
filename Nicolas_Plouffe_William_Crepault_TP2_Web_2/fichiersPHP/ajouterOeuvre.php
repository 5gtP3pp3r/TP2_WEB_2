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


    if (empty($_POST['titrePiece']) || !preg_match($regexNom, $_POST['titrePiece'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}


//Validation du champ Artiste
function validerChampsArtiste()
{

    $estNonValide = false;
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";

    if (empty($_POST['nomArtiste']) || !preg_match($regexNom, $_POST['nomArtiste'])) {
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

    if (empty($_POST['duree']) || !preg_match($sizeMBPattern, $_POST['duree'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Taille
function validerChampsTaille()
{
    $estNonValide = false;
    $regexTaille = '/[0-9]{1,4}/';

    if (empty($_POST['taille']) || !preg_match($regexTaille, $_POST['taille'])) {
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
    if (empty($_POST['prix']) || $_POST['prix'] > $MAX_VALUE || $_POST['prix'] < $MIN_VALUE || !preg_match($regexValeur, $_POST['prix'])) {
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

    if (empty($_POST['codeAlbum']) || !preg_match($codePattern, $_POST['codeAlbum'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Lien Youtube

function validerChampsLien()
{
    $estNonValide = false;
    $regexLien = '/^(http(s)?:\/\/)?((w){3}.)?youtu(be|.be)?(\.com)?\/.+/';

    if (!preg_match($regexLien, $_POST['lienYoutube'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation du champ Lyrics
function validerChampsLyrics()
{
    $estNonValide = false;
    $regexLyrics = '/^[a-zA-Z0-9 .\'-]*$/';

    if (empty($_POST['lyrics']) || !preg_match($regexLyrics, $_POST['lyrics'])) {
        return $estNonValide;
    }
    return $estNonValide = true;
}

//Validation des champs
function validerDesChampsAjoutOeuvre()
{
    return validerChampsPiece() && validerChampsArtiste() && validerChampsRole() && validerChampsTemps() && validerChampsTaille() && validerChampsValeur() && validerChampsDate() && validerChampsCode() && validerChampsLien() && validerChampsLyrics();
}

function injectionOeuvre()
{
    $conn = connexionBD(); // valeur prise en compte dans les validation mais qui n'ont pas de champs dans la bd
    try {
        $sql = "INSERT INTO oeuvre (titre_oeuvre, id_artiste, id_role, dureesec, taillemb, lyrics, date_ajout, id_album, prix) VALUES (:p_titrePiece, :p_NomArtiste, :p_role, :p_dureesec, : p_taillemb, :p_lyrics, :p_date_ajout, :prix,)";

        $stmt = $conn->prepare($sql); // Préparation de la requête

        $stmt->bindParam(':p_titrePiece', $_POST['titrePiece']);
        $stmt->bindParam(':p_NomArtiste', $_POST['nomArtiste']);
        $stmt->bindParam(':p_role', $_POST['role']);
        $stmt->bindParam(':p_dureesec', $_POST['duree']);
        $stmt->bindParam(':p_taillemb', $_POST['taille']);
        $stmt->bindParam(':p_lyrics', $_POST['lyrics']);
        $stmt->bindParam(':p_date_ajout', $_POST['datePublication']);
        $stmt->bindParam(':p_codeAlbum', $_POST['codeAlbum']);
        $stmt->bindParam(':prix', $_POST['prix']);
        //$stmt->bindParam(':p_lienYoutube', $_POST['lienYoutube']);

        $stmt->execute();
        $conn = null; // Fermeture de la connexion
    } catch (PDOException $e) {
        error_log("erreur ajout artiste: " . $e->getMessage());
        return false;
    }
}
