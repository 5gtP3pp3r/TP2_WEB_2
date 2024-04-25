<?php

if ($pageNom == 'pageAuth') {
} else {
    if (isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        header("Location: index.php");
        exit();
    }

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'CLIENT' || $_SESSION['role'] == 'ADMIN') {
    ?>
            <div class="d-flex justify-content-end mb-3">
                <form method="post"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
            </div>
        <?php
        } elseif ($_SESSION['role'] == 'GERANT' && $pageNom == 'pageAjoutUtilisateur') {
        ?>
            <div class="d-flex justify-content-end mb-3">
                <form method="post"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
            </div>
        <?php
        } elseif ($_SESSION['role'] == 'GERANT') {
        ?>
            <div class="d-flex justify-content-end mb-3">
                <button type="button" id="ajoutUtilisateur" class="styled-button">Ajout utilisateur</button>
            </div>
            <div class="d-flex justify-content-end mb-3">
                <form method="post"><button type="submit" name="logout" class="styled-button">Déconnexion</button></form>
            </div>
        <?php
        }
    } elseif ($pageNom == 'pageAjoutUtilisateur') {
        ?>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" id="connexion" class="styled-button">Connexion</button>
        </div>
    <?php
    } else {
    ?>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" id="enregistrer" class="styled-button">S'enregistrer</button>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <button type="button" id="connexion" class="styled-button">Connexion</button>
        </div>
<?php
    }
}
?>