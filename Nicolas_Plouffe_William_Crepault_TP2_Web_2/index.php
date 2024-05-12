<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset(); 
    session_destroy(); 
}
    header("Location: pageAccueil.php");
    exit;
?>


<!-- 
La page index détruit toutes les sessions en court! 
Par contre si on essait d'accéder à une page via l'url et que 
l'utilisateur n'a pas le bon rôle, il ne sera pas redirigé ici, 
mais à la pageAccueil.php pour ne pas fermer sa session.    -->