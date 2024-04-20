<?php

require_once('ConnectionDB.php');


function validerChampsNom()
{
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";
    $estValide = false;

    if (!empty($_POST['idArtiste']) && isset($_POST['idArtiste']) && preg_match($regexNom, $_POST['idArtiste'])) {
        $estValide = true;
    }

    return $estValide;
}


function validerChampsPhoto()
{

    $regexImage = "/^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/";
    $estValide = false;

    if (!empty($_POST['photoArtiste']) && isset($_POST['photoArtiste']) && preg_match($regexImage, $_POST['photoArtiste'])) {
        $estValide = true;
    }

    return $estValide;
}

function validerDesChamps()
{ {
        return validerChampsNom() && validerChampsPhoto();
    }
}

function injectionArtiste()
{
    $conn = connectionDB();
    $sql = "INSERT INTO artiste (nom_artiste, pht_artiste, id_ville) VALUES (:nom_artiste, :ville, :photoArtiste)";
    $stmt = $conn->prepare($sql); // Préparation de la requête

    $stmt->bindParam(':nom_artiste', $_POST['idArtiste']);
    $stmt->bindParam(':ville', $_POST['ville']);
    $stmt->bindParam(':photoArtiste', $_POST['photoArtiste']);

    $stmt->execute();
    $conn = null; // Fermeture de la connexion
}
