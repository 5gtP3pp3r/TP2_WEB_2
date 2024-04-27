<?php

// Validation des champs


// Validation Titre de l'album

function validerChampsTitre()
{
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";
    $estValide = false;

    if (!empty($_POST['titre']) && isset($_POST['titre']) && preg_match($regexNom, $_POST['titre'])) {
        $estValide = true;
    }

    return $estValide;
}

// Validation du Code de l'album

function validerChampsCode()
{
    $regexCode = "/^[A-Z]{3}[0-9]{4}$/";
    $estValide = false;

    if (!empty($_POST['code']) && isset($_POST['code']) && preg_match($regexCode, $_POST['code'])) {
        $estValide = true;
    }

    return $estValide;
}

//Validation de la date d'ajout de l'album

function validerDateAjout()
{
    $estValide = false;

    if (!empty($_POST['dateAjout']) && isset($_POST['dateAjout'])) {
        $estValide = true;
    }

    return $estValide;
}

//Validation du genre musical de l'album

function validerGenre()
{
    $estValide = false;

    if (!empty($_POST['genre']) && isset($_POST['genre'])) {
        $estValide = true;
    }

    return $estValide;
}

//Validation de la photo de l'album

function validerDesChamps()
{
    $estValide = false;
    $formatImage = "/^[^\s]+\.(jpg|jpeg|png|gif|bmp)$/";

    if (preg_match($formatImage, $_POST['photo'])) {
        $estValide = true; {
        }
        return;
    }
}



function AfficherMenuGenre()
{
    require_once("connexionBD.php");

    $pdo = connexionBD(); // Connexion à la base de données

    $sql = "SELECT * FROM genres"; // Requête SQL

    $pdoResultantBrute = $pdo->query($sql); // Exécution de la requête

    $ppoResultantDeployee = $pdoResultantBrute->fetchAll(); // Récupération des données

    foreach ($ppoResultantDeployee as $col => $colVal) {
        echo '<option value="' . $colVal["id"] . '">' . $colVal["nom_genre"] . '</option>';
    }

    $pdo = null; // Fermeture de la connexion

}


function injectionAlbum()
{

    $conn = connexionBD();
    try {
        $sql = "INSERT INTO albums (titre, code_album, date_album, id_genre, pht_couvt) VALUES (:p_titre, :p_code, :p_dateAjout. :p_genre,:photo )";

        $stmt = $conn->prepare($sql); // Préparation de la requête

        $stmt->bindParam(':p_titre', $_POST['titrePiece']);
        $stmt->bindParam(':p_code_album', $_POST['code']);
        $stmt->bindParam(':p_date_album', $_POST['dateAjout']);
        $stmt->bindParam(':p_id_genre', $_POST['genre']);
        $stmt->bindParam(':p_pht_couvt', $_POST['photo']);

        $stmt->execute();
        $conn = null; // Fermeture de la connexion
    } catch (PDOException $e) {
        error_log("erreur ajout album: " . $e->getMessage());
        return false;
    }
}

function testConnection()
{
    echo "test";
}
