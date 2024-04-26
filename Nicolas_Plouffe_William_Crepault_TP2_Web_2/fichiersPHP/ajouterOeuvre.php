<?php



function validerAjoutOeuvre()
{
    $regexNom = "/^[a-zàâçéèêëîïôûùüÿñæœ0-9 .'-]*$/i";
    $codePattern = '/[A-Z]{3}\d{4}/';
    $sizeMBPattern = '/[0-9]{1,4}/';
    $DurePattern = '/^\d+$/';




    $MAX_VALUE = 10;
    $MIN_VALUE = 0.00;
    $VALUE_ZERO = 0;

    $estNonValide = false;
    // Validation des champs

    //Validation du champ Pièce
    if (empty($_POST['pieceName']) || !isset($_POST['pieceName']) || !preg_match($regexNom, $_POST['pieceName'])) {
        return $estNonValide;
    }
    //Validation du champ Artiste
    if (empty($_POST['artistName']) || !isset($_POST['artistName']) || !preg_match($regexNom, $_POST['artistName'])) {
        return $estNonValide;
    }
    //Validation du champ Rôle

    //Validation du champ Temps
    if (empty($_POST['timeInSec']) || !isset($_POST['timeInSec']) || $_POST['timeInSec'] != $DurePattern) {
        return $estNonValide;
    }
    //Validation du champ Taille
    if (empty($_POST['sizeMB']) || !isset($_POST['sizeMB']) || $_POST['sizeMB'] != $sizeMBPattern) {
        return $estNonValide;
    }


    //Validation du champ Valeur
    if (empty($_POST['albumValue']) || !isset($_POST['albumValue']) || $_POST['albumValue'] < $MIN_VALUE || $_POST['albumValue'] > $MAX_VALUE) {
        return $estNonValide;
    }
    //Validation du champ Publication date

    //Validation du champ Code
    if (empty($_POST['albumCode']) || !isset($_POST['albumCode']) || !preg_match($codePattern, $_POST['albumCode'])) {
        return $estNonValide;
    }
    //Validation du champ Lien Youtube
    if (empty($_POST['youtubeLink']) || !isset($_POST['youtubeLink'])) {
        return $estNonValide;
    }


    //Validation du champ Lyrics
    if (empty($_POST['lyrics']) || !isset($_POST['lyrics'])) {
        return $estNonValide;
    }

    function injectionOeuvre()
    {
        $conn = connexionBD();
        try {
            $sql = "INSERT INTO oeuvre (titre_oeuvre, dureesec, id_ville, taillemb, lyrics,date_ajout,prix) VALUES (:titre_oeuvre, :dureesec, :taillemb, :lyrics, :date_ajout, :prix)";

            $stmt = $conn->prepare($sql); // Préparation de la requête

            $stmt->bindParam(':nomArtiste', $_POST['idArtiste']);
            $stmt->bindParam(':photoArtiste', $_POST['photoArtiste']);
            $stmt->bindParam(':ville', $_POST['ville']);

            $stmt->execute();
            $conn = null; // Fermeture de la connexion
        } catch (PDOException $e) {
            error_log("erreur ajout artiste: " . $e->getMessage());
            return false;
        }
    }
}
