<?php

require_once('connexionBD.php');


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

function GestionMenuVille()
{
    require_once('connexionBD.php');

    $pdo = connecxionBD(); // Connexion à la base de données

    $sql = "SELECT * FROM villes"; // Requête SQL

    $pdoResultantBrute = $pdo->query($sql); // Exécution de la requête

    $ppoResultantDeployee = $pdoResultantBrute->fetchAll(); // Récupération des données

    foreach ($ppoResultantDeployee as $col => $colVal) {
        echo '<option value="' . $colVal["id"] . '">' . $colVal["nom_ville"] . '</option>';
    }
    $pdo = null; // Fermeture de la connexion

}

function injectionArtiste()
{

    $conn = connecxionBD();
    $sql = "INSERT INTO artistes (nom_artiste, pht_artiste, id_ville) VALUES (:nomArtiste, :photoArtiste, :ville )";

    $stmt = $conn->prepare($sql); // Préparation de la requête

    $stmt->bindParam(':nomArtiste', $_POST['idArtiste']);
    $stmt->bindParam(':photoArtiste', $_POST['photoArtiste']);
    $stmt->bindParam(':ville', $_POST['ville']);

    $stmt->execute();
    $conn = null; // Fermeture de la connexion


}

function testConnection()
{

    echo "test";
}
