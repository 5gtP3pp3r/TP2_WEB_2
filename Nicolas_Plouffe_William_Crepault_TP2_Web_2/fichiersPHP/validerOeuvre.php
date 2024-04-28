<?php
require_once 'connexionBD.php';

function validerOeuvre()
{

    $regExNom = "/^[a-zA-Z0-9 ]+$/";
    $ZERO = 0;
    $Max = 999;
    $ValeurMin = 0;
    $ValeurMax = 10;
    $regexLyrics = "/^[a-zA-Z0-9 ]+$/";


    $errors = [];
    

    if (empty($_POST['titrePiece'])) {
        $errors[] = "Le titre de l'oeuvre est requis.";
    } else if (!preg_match($regExNom, $_POST['titrePiece'])) {
        $errors[] = 'Le titre doit contenir au moins 1 caractère,accèpte les accents, les espaces, ".","-" et les "_"';
    }

    if ($_POST['nomArtiste'] == 0) {
        $errors[] = "Choisir un artiste parmis la liste.";
    }

    if ($_POST['role'] == 0) {
        $errors[] = "Vous devez choisir un rôle.";
    }

    if (empty($_POST['duree']) || $_POST['duree'] <= $ZERO) {
        $errors[] = "La durée est requise.";
    } else if ($_POST['duree'] > $Max) {
        $errors[] = "La durée ne doit pas dépasser 999 secondes.";
    }

    if (!empty($_POST['taille']) && $_POST['taille'] <= $ZERO) {
        $errors[] = 'La valeur doit être entre 1 et "$DureeMax" mb.';
    } else if ($_POST['taille'] > $Max) {
        $errors[] = "La taille ne doit pas dépasser 999 mb.";
    }

    if (empty($_POST['prix']) || $_POST['prix'] < $ValeurMin) {
        $errors[] = 'La valeur requise doit être suppérieure à "$ZERO" $.';
    } else if ($_POST['prix'] > $ValeurMax) {
        $errors[] = 'La valeur ne doit pas dépasser " $ValeurMax" $.';
    }

    if (empty($_POST['datePublication'])) {
        $errors[] = "La date d'aujourd'hui est requise.";
    } else if ($_POST['datePublication'] > date('Y-m-d')) {
        $errors[] = "La date ne doit pas être supérieure à la date d'aujourd'hui.";
    }

    if ($_POST['codeAlbum'] == 0) {
        $errors[] = "Choisir un code d'album parmis la liste.";
    }    

    if (!empty($_POST['lyrics']) && !preg_match($regexLyrics, $_POST['lyrics'])) {
        $errors[] = "Les paroles ne doivent contenir que des lettres, des chiffres, des espaces, des apostrophes et des tirets.";
    }

    if (count($errors) == 0) {

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
        return $errors;
    }
}
