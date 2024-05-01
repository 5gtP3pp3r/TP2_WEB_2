<?php

if ($pageNom != 'pageAuth') {

    if (isset($_GET['logout'])) {  
        header("Location: index.php");
        session_unset();
        session_destroy();
        
        exit();
    }
?>
    <div class="row">
        <?php
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] == 'CLIENT' || $_SESSION['role'] == 'ADMIN') {
        ?>
                <div class="col-sm-12 d-flex justify-content-end mb-3">
                    <form method="get"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
                </div>
            <?php
            } elseif ($_SESSION['role'] == 'GERANT' && $pageNom == 'pageUtilisateur') {
            ?>
                <div class="col-sm-12 d-flex justify-content-end mb-3">
                    <form method="get"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
                </div>
            <?php
            } elseif ($_SESSION['role'] == 'GERANT') {
            ?>
                <div class="col-sm-12 d-flex justify-content-end mb-3">
                    <button type="button" id="ajoutUtilisateur" class="styled-button">Ajout utilisateur</button>
                </div>
                <div class="col-sm-12 d-flex justify-content-end mb-3">
                    <form method="get"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
                </div>
            <?php
            }
        } elseif ($pageNom == 'pageAjoutUtilisateur') {
            ?>
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                <button type="button" id="connexion" class="styled-button">Connexion</button>
            </div>
        <?php
        } else {
        ?>
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                <button type="button" id="enregistrer" class="styled-button">S'enregistrer</button>
            </div>
            <div class="col-sm-12 d-flex justify-content-end mb-3">
                <button type="button" id="connexion" class="styled-button">Connexion</button>
            </div>
    <?php
        }
    }
    ?>
    </div>