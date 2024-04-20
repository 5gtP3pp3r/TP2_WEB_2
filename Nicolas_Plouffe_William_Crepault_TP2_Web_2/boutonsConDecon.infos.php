
<?php

    session_start();

    // faire apparaitre les bon boutons avec role session
//    if(isset($_SESSION['user']) && $_SESSION['user'] == 'admin')
//    {
        echo '<button type="button" id="ajoutUtilisateur" class="styled-button">Ajout utilisateur</button>';
        echo '<button type="button" id="deconnexion" class="styled-button">Déconnecxion</button>';
//    }
//    else 
//    {
        echo '<button type="button" id="connexion" class="styled-button">Connecxion</button>';
//    }
        
?>