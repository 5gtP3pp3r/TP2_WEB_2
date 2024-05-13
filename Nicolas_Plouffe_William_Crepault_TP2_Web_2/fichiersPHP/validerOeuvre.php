<?php
require_once 'connexionBD.php';

function validerOeuvre()
{

    $regExNom = "/^[a-zà-öø-ÿ]+(?:[ \-_.]*[a-zà-öø-ÿ]+)*/i";
    $ZERO = 0;
    $Max = 999;
    $ValeurMin = 0;
    $ValeurMax = 10;
    $regexLyrics = "/^[a-zA-Z0-9 ]+$/";

    $erreurs = [];

    if (empty($_POST['titrePiece'])) {
        $erreurs[] = "Le titre de l'oeuvre est requis.";
    } else if (!preg_match($regExNom, $_POST['titrePiece'])) {
        $erreurs[] = 'Le titre doit contenir que des lettres, des chiffres et des espaces';
    }

    if ($_POST['nomArtiste'] == 0) {
        $erreurs[] = "Choisir un artiste parmis la liste.";
    }

    if ($_POST['role'] == 0) {
        $erreurs[] = "Choisir un rôle parmis la liste.";
    }

    if (empty($_POST['duree']) || $_POST['duree'] <= $ZERO) {
        $erreurs[] = "La durée est requise.";
    } else if ($_POST['duree'] > $Max) {
        $erreurs[] = "La durée ne doit pas dépasser 999 secondes.";
    }

    if (!empty($_POST['taille']) && $_POST['taille'] <= $ZERO) {
        $erreurs[] = "La valeur doit être entre 1 et $Max mb.";
    } else if (!empty($_POST['taille']) && $_POST['taille'] > $Max) {
        $erreurs[] = "La taille ne doit pas dépasser 999 mb.";
    }

    if (empty($_POST['prix']) || $_POST['prix'] < $ValeurMin) {
        $erreurs[] = "La valeur requise doit être suppérieure à $ZERO $.";
    } else if ($_POST['prix'] > $ValeurMax) {
        $erreurs[] = "La valeur ne doit pas dépasser $ValeurMax $.";
    }

    if (empty($_POST['datePublication'])) {
        $erreurs[] = "La date de publication est requise.";
    } else if ($_POST['datePublication'] >= date('Y-m-d')) {
        $erreurs[] = "La date ne doit pas être supérieure ou égale à la date d'aujourd'hui.";
    }

    if ($_POST['codeAlbum'] == 0) {
        $erreurs[] = "Choisir un code d'album parmis la liste.";
    }

    if (!empty($_POST['lyrics']) && !preg_match($regexLyrics, $_POST['lyrics'])) {
        $erreurs[] = "Les paroles ne doivent contenir que des lettres, des chiffres et des espaces.";
    }

    if (count($erreurs) == 0) {

        $titrePiece = $_POST['titrePiece'];
        $nomArtiste = $_POST['nomArtiste'];
        $role = $_POST['role'];
        $duree = $_POST['duree'];
        $taille = $_POST['taille'];
        $prix = $_POST['prix'];
        $datePublication = $_POST['datePublication'];
        $codeAlbum = $_POST['codeAlbum'];
        $lyrics = $_POST['lyrics'];

        $resultat = ajouterOeuvreBD($titrePiece, $nomArtiste, $role, $duree, $taille, $prix, $datePublication, $codeAlbum, $lyrics);
        if ($resultat) {
            return "Oeuvre ajoutée avec succès !";
        } else {
            return ["Erreur lors de l'ajout de l'oeuvre dans la base de données."];
        }
    } else {
        return $erreurs;
    }
}
