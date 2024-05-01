<?php
require_once 'connexionBD.php';

function validerAlbum()
{
    date_default_timezone_set('Etc/GMT+4');

    $errors = [];

    if (empty($_POST['titre'])) {
        $errors[] = "Le titre est requis.";
    } elseif (!preg_match("/^[a-z0-9à-öø-ÿ]+(?:[ \-_.]*[a-z0-9à-öø-ÿ]+)*$/i", $_POST['titre'])) {
        $errors[] = 'Le titre doit contenir au moins 1 caractère,accèpte les accents, les espaces, ".","-" et les "_" ';
    }

    if (empty($_POST['code'])) {
        $errors[] = "Le code album est requis.";
    } elseif (!preg_match("/^[A-Z]{3}[0-9]{4}$/", $_POST['code'])) {
        $errors[] = "Le code doit contenir 3 lettres majuscule suivit de 4 chiffres.";
    }

    if (empty($_POST['dateAjout']) || $_POST['dateAjout'] != date("Y-m-d")) {
        $errors[] = "La date d'aujourd'hui est requise.";
    }

    if (empty($_POST['genreMusical']) || $_POST['genreMusical'] == 0) {
        $errors[] = "Vous devez choisir un genre.";
    }

    if (empty($_POST['photo'])) {
        $errors[] = "Le nom de la photo est requis";
    }

    // AJOUTER VALIDATION CODE ALBUM UNIQUE

    if (count($errors) === 0) {

        $titre = $_POST['titre'];
        $code = $_POST['code'];
        $dateAjout = $_POST['dateAjout'];
        $genreMusical = $_POST['genreMusical'];
        $photo = $_POST['photo'];

        $resultat = ajouterAlbumBD($titre, $code, $dateAjout, $genreMusical, $photo);

        if ($resultat) {
            return "Album ajouté avec succès !";
        } else {
            return ["Erreur lors de l'ajout de l'album dans la base de données."];
        }
    } else {
        return $errors;
    }
}
