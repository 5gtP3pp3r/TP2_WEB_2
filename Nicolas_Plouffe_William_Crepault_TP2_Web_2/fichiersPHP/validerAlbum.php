<?php
require_once 'connexionBD.php';

function validerAlbum()
{
    date_default_timezone_set('Etc/GMT+4');

    $erreurs = [];

    if (empty($_POST['titre'])) {
        $erreurs[] = "Le titre est requis.";
    } elseif (!preg_match("/^[a-z0-9à-öø-ÿ]+(?:[ \-_.]*[a-z0-9à-öø-ÿ]+)*$/i", $_POST['titre'])) {
        $erreurs[] = 'Le titre doit contenir au moins 1 caractère,accèpte les accents, les espaces, ".","-" et les "_" ';
    }

    if (empty($_POST['code'])) {
        $erreurs[] = "Le code album est requis.";
    } elseif (!preg_match("/^[A-Z]{3}[0-9]{4}$/", $_POST['code'])) {
        $erreurs[] = "Le code doit contenir 3 lettres majuscule suivit de 4 chiffres.";
    }

    if (empty($_POST['dateAjout']) || $_POST['dateAjout'] != date("Y-m-d")) {
        $erreurs[] = "La date d'aujourd'hui est requise.";
    }

    if (empty($_POST['genreMusical']) || $_POST['genreMusical'] == 0) {
        $erreurs[] = "Vous devez choisir un genre.";
    }

    if (!empty($_POST['photo']) && !preg_match("/^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/i", $_POST['photo'])) {
        $erreurs[] = "Le nom de la photo est requis";
    }

    $codeAlbumArray = chercherCodeAlbum();
    $codeEntrant = $_POST['code'];

    if (in_array($codeEntrant, $codeAlbumArray)) {
        $erreurs[] = "Code album existant";
    }

    if (count($erreurs) === 0) {

        $titre = $_POST['titre'];
        $code = $_POST['code'];
        $dateAjout = $_POST['dateAjout'];
        $genreMusical = $_POST['genreMusical'];
        $photo = $_POST['photo'];

        if (empty($photo)) {                // puisque l'image peut être un problème, si aucune image 
            $photo = "aucune_image.png";    // n'est entrée "aucune_image.png" sera l'image par défaut
        } else {
            $dossierImages = 'Images/';
            $cheminImage = $dossierImages . $photo;

            if (!file_exists($cheminImage)) {
                $erreurs[] = 'L\'image n\'existe pas dans le dossier "Images"';
            }
        }
        if (empty($erreurs)) {
            $resultat = ajouterAlbumBD($titre, $code, $dateAjout, $genreMusical, $photo);
            if ($resultat) {
                return "Album ajouté avec succès !";
            } else {
                $erreurs[] = "Erreur lors de l'ajout de l'album dans la base de données.";
                return $erreurs;
            }
        } else {
            return $erreurs; 
        }
    } else {
        return $erreurs;  
    }
}
