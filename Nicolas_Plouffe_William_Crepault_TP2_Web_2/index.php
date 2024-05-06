<?php
session_start();

if (session_status() === PHP_SESSION_ACTIVE) {
    session_unset(); 
    session_destroy(); 
    session_write_close(); 
    setcookie(session_name(),'',0,'/'); 
    session_regenerate_id(true); 
}
    header("Location: pageAccueil.php");
?>


<!-- 
La page index détruit toutes les sessions en court! 
Par contre si on essait d'accéder à une page via l'url et que 
l'utilisateur n'a pas le bon rôle, il ne sera pas redirigé ici, 
mais à la pageAccueil.php pour ne pas fermer sa session.    -->