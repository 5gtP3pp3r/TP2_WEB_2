<?php
require_once "Panier.class.php";
require_once "Utilisateur.class.php";

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
    $reqSql = "SELECT id, nom_ville FROM villes";
    $stmt = $conn->prepare($reqSql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function chercherIdUserDispo()
{
    $conn = connexionBD();
    $reqSql = "SELECT id FROM utilisateurs WHERE id BETWEEN 5 AND 11";
    $stmt = $conn->prepare($reqSql);
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

function chercherUtil($motPasse, $email)
{
    $conn = connexionBD();
    $reqSql = "SELECT * FROM utilisateurs WHERE courriel = :email";
    $reponse = $conn->prepare($reqSql);
    $reponse->bindParam(':email', $email, PDO::PARAM_STR);
    $reponse->execute();

    $utilisateur = $reponse->fetch(PDO::FETCH_ASSOC);
    if ($utilisateur) {
        if (password_verify($motPasse, $utilisateur['mot_passe'])) {
            return $utilisateur;
        }
    }
    return null;
}

function chercherOeuvre($idOeuvre)
{
    $conn = connexionBD();
    $resultset = [];

    if ($idOeuvre == "-1") {
        $reqSql = "SELECT oeuvres.id, pht_couvt, oeuvres.titre_oeuvre, oeuvres.prix FROM oeuvres
                   INNER JOIN albums ON oeuvres.id_album = albums.id";
        $reponse = $conn->prepare($reqSql);
    } else {
        $reqSql = "SELECT oeuvres.id, pht_couvt, oeuvres.titre_oeuvre, prix FROM oeuvres
                   INNER JOIN albums ON  albums.id = oeuvres.id_album
                   WHERE oeuvres.id = :id
                   ORDER BY oeuvres.id";
        $reponse = $conn->prepare($reqSql);
        $reponse->bindParam(':id', $idOeuvre, PDO::PARAM_INT);
    }

    $reponse->execute();

    while ($donnees = $reponse->fetch()) {
        $idOeuvre = $donnees['id'];
        $AlbumImg = $donnees['pht_couvt'];
        $titreOeuvre = $donnees['titre_oeuvre'];
        $prix = $donnees['prix'];
        $oeuvre = new Oeuvre($idOeuvre, $AlbumImg, $titreOeuvre, $prix);

        $resultset[] = $oeuvre;
    }
    if (!empty($resultset))
        return $resultset;   
}

function ajoutUtilisateurBD($roleId, $nom, $email, $motPasseHash, $ville, $age)
{
    $conn = connexionBD();
    try {
        if ($roleId >= 6 && $roleId <= 10) {
            $reqSql = "INSERT INTO utilisateurs (id, nom, courriel, mot_passe, id_ville, age) 
                       VALUES (:id, :nom, :email, :motPasseHash, :ville, :age)";
            $reponse = $conn->prepare($reqSql);
            $reponse->bindParam(':id', $roleId, PDO::PARAM_INT);
        } 
        elseif ($roleId == 1) {
            $reqSql = "INSERT INTO utilisateurs (nom, courriel, mot_passe, id_ville, age) 
                       VALUES (:nom, :email, :motPasseHash, :ville, :age)";
            $reponse = $conn->prepare($reqSql);
        }
      
        $reponse->bindParam(':nom', $nom, PDO::PARAM_STR);
        $reponse->bindParam(':email', $email, PDO::PARAM_STR);
        $reponse->bindParam(':motPasseHash', $motPasseHash, PDO::PARAM_STR);
        $reponse->bindParam(':ville', $ville, PDO::PARAM_INT);
        $reponse->bindParam(':age', $age, PDO::PARAM_INT);
        
        $reponse->execute();

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
    $conn = connexionBD();
    $utilisateur = unserialize($_SESSION['user']);
    $idUtil = $utilisateur->getId();    
    $dateCommande = date("Y-m-d H:i:s");

    try {
        $reqSql = "INSERT INTO commandes (id_utilisateur, date_commande)
                   VALUES (:id_utilisateur, :dateCommande)";
        $reponse = $conn->prepare($reqSql);
        $reponse->bindParam(':id_utilisateur', $idUtil, PDO::PARAM_INT);
        $reponse->bindParam(':dateCommande', $dateCommande, PDO::PARAM_STR);

        $reponse->execute();
    
        $idCommande = $conn->lastInsertId();
        $oeuvreComms = $monPanier->getItems();

        $ligneCommande = [];

        foreach ($oeuvreComms as $oeuvreComm){
            $idOeuvre = $oeuvreComm['item']->getIdOeuvre();
        
            $ligneCommande[] = [
                'id_oeuvre' => $idOeuvre,
                'quantite' => $oeuvreComm['qty']
            ];        
        }   
        foreach ($ligneCommande as $commande){
            $idOeuvre = $commande['id_oeuvre'];
            $quantite = $commande['quantite'];

            $reqSql = "INSERT INTO ligne_commandes (id_commande, id_oeuvre, Quantite)
                       VALUES (:id_commande, :id_oeuvre, :quantite)";
            $reponse = $conn->prepare($reqSql);
            $reponse->bindParam(':id_commande', $idCommande, PDO::PARAM_INT);
            $reponse->bindParam(':id_oeuvre', $idOeuvre, PDO::PARAM_INT);
            $reponse->bindParam(':quantite', $quantite, PDO::PARAM_INT);

            $reponse->execute();
        }
        return true;
    }
    catch (PDOException $e) {
        error_log("Erreur lors de l'ajout de commande: " . $e->getMessage());
        return false;
    }
}
  