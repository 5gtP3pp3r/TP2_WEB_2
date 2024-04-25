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

function chercherIdUserDispo()
{
    $conn = connexionBD();
    $sql = "SELECT id FROM utilisateurs WHERE id BETWEEN 5 AND 11";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $idsUtilises = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

    $idsDisponibles = [];
    for ($id = 5; $id < 11; $id++) {
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

function chercherOeuvre($idOeuvre)
{
    $conn = connexionBD();
    $resultset = [];

    if ($idOeuvre == "-1") {
        $reqsql = "SELECT oeuvres.id, pht_couvt, oeuvres.titre_oeuvre, oeuvres.prix FROM oeuvres
                   INNER JOIN albums ON oeuvres.id_album = albums.id";
        $reponse = $conn->prepare($reqsql);
    } else {
        $reqsql = "SELECT oeuvres.id, pht_couvt, oeuvres.titre_oeuvre, prix FROM oeuvres
                   INNER JOIN albums ON  albums.id = oeuvres.id_album
                   WHERE oeuvres.id = :id
                   ORDER BY oeuvres.id";
        $reponse = $conn->prepare($reqsql);
        $reponse->bindParam(':id', $idOeuvre, PDO::PARAM_STR);
    }

    $reponse->execute();

    while ($donnees = $reponse->fetch()) {
        $idOeuvre = $donnees['id'];
        $AlbumImg = $donnees['pht_couvt'];
        $titreOeuvre = $donnees['titre_oeuvre'];
        $prix = $donnees['prix'];
        $p = new Oeuvre($idOeuvre, $AlbumImg, $titreOeuvre, $prix);

        $resultset[] = $p;
    }
    if (!empty($resultset))
        return $resultset;   
}

function ajoutUtilisateurBD($nom, $email, $motPasseHash, $ville, $age, $roleId)
{
    $conn = connexionBD();
    try {
        if ($roleId > 5 && $roleId < 11) {
            $sql = "INSERT INTO utilisateurs (id, nom, courriel, mot_passe, id_ville, age) VALUES (:id, :nom, :email, :motPasseHash, :ville, :age)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $roleId, PDO::PARAM_INT); 
            // urRole GERANT déterminé par le ID si disponible
        } 
        elseif ($roleId == 1) {
            $sql = "INSERT INTO utilisateurs (nom, courriel, mot_passe, id_ville, age) VALUES (:nom, :email, :motPasseHash, :ville, :age)";
            $stmt = $conn->prepare($sql);
        }

        $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':motPasseHash', $motPasseHash, PDO::PARAM_STR);
        $stmt->bindParam(':ville', $ville, PDO::PARAM_INT);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);

        $stmt->execute();

        if ($roleId > 5 && $roleId < 11) {
            $updateSql = "UPDATE utilisateurs SET urRole = 'GERANT' WHERE id > 5 AND id < 11";
            $updateStmt = $conn->prepare($updateSql);
            $updateStmt->execute();
        }

        return true;
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de l'utilisateur: " . $e->getMessage());
        return false;
    }
}

function ajouterCommande($monPanier)
{
    require_once "Panier.class.php";
    $oeuvreComms = $monPanier->getItems();
    $ligneCommande = [];

    foreach ($oeuvreComms as $oeuvreComm){
        $idOeuvre = $oeuvreComm['item']->getIdOeuvre();

        $ligneCommande[] = [
            'id_oeuvre' => $idOeuvre,
            'Quantite' => $oeuvreComm['qty']
        ];
        var_dump($ligneCommande);
    }

    $conn = connexionBD();
    try {

    }
    catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de commande: " . $e->getMessage());
        return false;
    }
    // à construire   insert dans commandes: id, id_utilisateur, date_commande, etat_commande
    //                insert dabs ligne_commandes: id, id_oeuvre, Quantite
}

