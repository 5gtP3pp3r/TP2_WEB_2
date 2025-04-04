<?php
require_once 'connexionBD.php';

function validerUtilisateur()
{
    $erreurs = [];

    if (empty($_POST['nomUtilisateur'])) {
        $erreurs[] = "Le nom d'utilisateur est requis.";
    } elseif (!preg_match('/^[a-zA-Z0-9]{6,45}$/', $_POST['nomUtilisateur'])) {
        $erreurs[] = "Le nom d'utilisateur doit contenir entre 6 et 45 caractères alphanumériques.";
    }

    if (empty($_POST['email'])) {
        $erreurs[] = "L'email est requis.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }

    if (empty($_POST['password'])) {
        $erreurs[] = "Le mot de passe est requis.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $_POST['password'])) {
        $erreurs[] = "Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    }

    if (empty($_POST['ville']) || $_POST['ville'] == '0') {
        $erreurs[] = "Choix de ville requis.";
    }

    if (empty($_POST['role']) || $_POST['role'] == '0') {
        $erreurs[] = "Choix d'un rôle requis.";
    }

    if (empty($_POST['age'])) {
        $erreurs[] = "L'âge est requis.";
    } elseif ($_POST['age'] < 18 || $_POST['age'] > 100) {
        $erreurs[] = "L'âge doit être entre 18 et 100 ans.";
    }

    $mailArray = chercherEmail();
    $mailEntrant = $_POST['email'];

    if (in_array($mailEntrant, $mailArray)) {
        $erreurs[] = "Adresse courrielle existante";
    } 
    if (count($erreurs) === 0) {

        $nom = $_POST['nomUtilisateur'];
        $email = $_POST['email'];
        $motPasse = $_POST['password'];
        $motPasseHash = password_hash($motPasse, PASSWORD_DEFAULT);
        $ville = $_POST['ville'];
        $roleId = $_POST['role'];
        $age = $_POST['age'];
        
            $resultat = ajoutUtilisateurBD($roleId, $nom, $email, $motPasseHash, $ville, $age);
            $nouvelUtil = chercherUtil($email, $motPasse);

            if ($nouvelUtil) {
                new Utilisateur(
                    $nouvelUtil['nom'],
                    $nouvelUtil['email'],
                    $nouvelUtil['password'],
                    $nouvelUtil['ville'],
                    $nouvelUtil['role'],
                    $nouvelUtil['age']
                );
            }

            if ($resultat) {
                return "Utilisateur ajouté avec succès !";
            } else {
                return ["Erreur lors de l'ajout de l'utilisateur dans la base de données."];
            }
        
    } else {
        return $erreurs;
    }
}
