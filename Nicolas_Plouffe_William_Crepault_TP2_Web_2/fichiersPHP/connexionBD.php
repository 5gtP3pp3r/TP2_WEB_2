<?php

function connecxionBD()
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

function chercherUser($username, $email)
{
    $conn = connecxionBD();
    $sql = "SELECT * FROM utilisateurs WHERE nom = :username AND courriel = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        return $user;
    }

    return null;
}

function chercherOeuvre($p_idOeuvre)
{
    $conn = connecxionBD();
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
