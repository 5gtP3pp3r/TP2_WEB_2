<?php
require_once("connexionBD.php");

function validerArtiste()
{
    $errors = [];

    if (empty($_POST['nomArtiste'])) {
        $errors[] = "Le nom de l'artiste est requis.";
    } elseif (!preg_match("/^[a-zà-öø-ÿ]+(?:[ \-_.]*[a-zà-öø-ÿ]+)*/i", $_POST['nomArtiste'])) {
        $errors[] = 'Le nom de l\'artiste doit contenir au moins 1 caractère,accèpte les accents, les espaces, ".","-" et les "_" ';
    }

    if ($_POST["ville"] == 0) {
        $errors[] = "Vous devez choisir une ville.";
    }

    if (empty($_POST['photoArtiste']) || !preg_match("/^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/", $_POST['photoArtiste'])) {
        $errors[] = "Format de l'image invalide.";
    }

    if (count($errors) === 0) {

        $nomArtiste = $_POST['nomArtiste'];
        $ville = $_POST['ville'];
        $photoArtiste = $_POST['photoArtiste'];


        $resultat = ajouterArtisteBD($nomArtiste, $ville, $photoArtiste);

        if ($resultat) {
            return "Artiste ajouté avec succès !";
        } else {
            return ["Erreur lors de l'ajout de l'artiste dans la base de données."];
        }
    } else {
        return $errors;
    }
}
