<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("heads.infos.php");
require_once 'fichiersPHP/validerUtilisateur.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resultats = validerUtilisateur();
}

?>
<?php
if (isset($_SESSION['role'])) {
    if ($_SESSION['role'] == 'ADMIN') {
        echo '<h2>Enregistrer un utilisateur</h2>';
    }
} else {
    echo '<h2>S\'enregistrer</h2>';
}
?>
<div class="container-fluid">
    <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
        <?php include("boutonsConDecon.infos.php"); ?>
    </div>
    <div class="row py-4">
        <div class="col-sm-1 col-md-6 mb-3">
            <div class="custom-border px-2 container-fluid">
                <h3>Tout les champs sont obligatoires</h3>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="row py-2">
                        <div class="col-sm-12 col-md-6">
                            <label for="nomUtilisateur">Nom d'utilisateur</label>
                            <input type="text" id="nomUtilisateur" name="nomUtilisateur" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-3">
                            <label for="age">Age</label><Span class="red"> (18 ans et plus)</Span>
                            <input type="number" id="age" name="age" placeholder="max 100" min="18" max="100" step="1" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="email">Courriel</label>
                            <input type="email" id="email" name="email" placeholder="nom@domaine.com" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="ville">Ville</label>
                            <select id="ville" name="ville" class="form-control">
                                <option value="0">Choix de villes</option>
                                <?php chercherVilles(); ?>
                            </select>
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="password">Mot de passe</label>
                            <input type="password" id="password" name="password" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label class="red" for="confPassword">Confirmer mot de passe</label>
                            <input type="password" id="confPassword" name="confPassword" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-6">
                            <label for="role">Rôle</label>
                            <select id="role" name="role" class="form-control">
                                <option value="0">Choix de rôle</option>
                                <?php
                                echo '<option value="1">Client</option>';
                                if (isset($_SESSION['role'])) {
                                    if ($_SESSION['role'] == 'GERANT') {
                                        $idsDisponibles = chercherIdUserDispo();
                                        if (empty($idsDisponibles)) {
                                ?>
                                            <option disabled>Espace gérant non disponible</option>
                                <?php
                                        } else {
                                            foreach ($idsDisponibles as $idDisponible) {
                                                echo '<option value="' . $idDisponible . '">Gérant (ID: ' . $idDisponible . ')</option>';
                                            }
                                        }
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="ulBtn">
                            <ul class="bntListe">
                                <li><button type="reset" id="resetUS0" class="styled-button">Effacer</button></li>
                                <li><button type="submit" id="submitUS0" class="styled-button">Enregistrer</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 mb-3">
            <div class="custom-border px-2">
                <h3>Informations sur l'utilisateur</h3>
                <div class="validationList" id="resultList">
                    <ul class="validationUl" id="listResult">
                        <!-- Zone de validation client -->
                        <?php
                        if (isset($resultats) && is_array($resultats)) {
                            foreach ($resultats as $resultat) {
                                echo '<li class="text-danger"><p>' . htmlspecialchars($resultat) . '</p></li>';
                            }
                        } elseif (isset($resultats)) {
                            echo '<li class="text-success"><p>' . htmlspecialchars($resultats) . '</p></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php include("foots.infos.php"); ?>