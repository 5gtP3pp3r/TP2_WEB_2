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

function ChercherUser($username, $password) {   
    $conn = connecxionBD();
    $sql = "SELECT * FROM utilisateurs WHERE nom = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['mot_passe'])) {
        return $user;
    }
    
    return null;
}