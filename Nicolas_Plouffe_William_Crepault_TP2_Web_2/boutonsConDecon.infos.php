
<?php

if (isset($_POST['logout'])) {
        session_unset(); 
        session_destroy(); 
        header("Location: index.php"); 
        exit();
    }
    
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'CLIENT' || $_SESSION['role'] == 'ADMIN') {
            echo '<form method="post"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>';
        } elseif ($_SESSION['role'] == 'GERANT') {
            echo '<button type="button" id="ajoutUtilisateur" class="styled-button">Ajout utilisateur</button>';
            echo '<form method="post"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>';
        }
    } else {
        echo '<button type="button" id="connexion" class="styled-button">Connexion</button>';
    }
?>