<?php

function connexionBD()
{
    try {

        $serverName = 'localhost';
        $userName = 'root';
        $password = '';
        $bd = 'tp2_media_web';

        $conn = new PDO("mysql:host=$serverName;dbname=$bd", $userName, $password);
        return $conn;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function chercherVilles()
{
    $conn = connexionBD();
    $sql = "SELECT id, nom_ville FROM villes";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function chercherIdUserDispo() {
    $conn = connexionBD();
    // Sélectionner tous les IDs utilisés entre 5 et 11
    $sql = "SELECT id FROM utilisateurs WHERE id BETWEEN 5 AND 11";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $idsUtilises = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    // Trouver les IDs non utilisés dans la plage
    $idsDisponibles = [];
    for ($id = 5; $id <= 11; $id++) {
        if (!in_array($id, $idsUtilises)) {
            $idsDisponibles[] = $id;
        }
    }
    return $idsDisponibles;
}

function chercherUser($motPasse, $email)
{
    $conn = connexionBD();
    $sql = "SELECT * FROM utilisateurs WHERE courriel = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        if (password_verify($motPasse, $user['mot_passe'])) {
            return $user; 
        }
    }
    return null;
}

function chercherOeuvre($p_idOeuvre)
{
    $conn = connexionBD();
    $resultset = [];

    if ($p_idOeuvre == "-1") {
        $reqsql = "SELECT albums.code_album, oeuvres.titre_oeuvre, oeuvres.prix FROM oeuvres
                   INNER JOIN albums ON oeuvres.id_album = albums.id";
        $reponse = $conn->prepare($reqsql);
    } else {
        $reqsql = "SELECT oeuvres.id, code_album, oeuvres.titre_oeuvre, prix FROM oeuvres
                 INNER JOIN albums ON  albums.id = oeuvres.id_album
                 WHERE oeuvre.id = :oeuvre.id
                 ORDER BY oeuvres.id";
        $reponse = $conn->prepare($reqsql);
        $reponse->bindParam(':oeuvre.id', $idOeuvre, PDO::PARAM_STR);
    }

    $reponse->execute();

    while ($donnees = $reponse->fetch()) {
        $idOeuvre = $donnees['code_album'];
        $codeAlbum = $donnees['code_album'];
        $titreOeuvre = $donnees['titre_oeuvre'];
        $prix = $donnees['prix'];
        $p = new Oeuvre($idOeuvre, $codeAlbum, $titreOeuvre, $prix);

        $resultset[] = $p;
    }
    if (!empty($resultset))
        return $resultset;
}
