<?php
include("heads.infos.php");
include('fichiersPHP/connexionBD.php');

?>

<main>
    <?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'GERANT') {
            echo '<h1>Enregistrer un utilisateur</h1>';
        }
    } else {
        echo '<h1>S\'enregistrer</h1>';
    }
    ?>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2 container-fluid">
                    <h3>Tout les champs sont obligatoires</h3>
                    <form action="submit">
                        <div class="row py-2">
                            <div class="col-sm-12 col-md-6">
                                <label for="nomUtilisateur">Nom d'utilisateur</label>
                                <input type="text" id="nomUtilisateur" name="nomUtilisateur" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="age">Age</label><Span> (18 ans et plus)</Span>
                                <input type="number" id="age" name="age" placeholder="max 120" min="18" step="1" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="email">Courriel</label>
                                <input type="email" id="email" name="email" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="ville">Ville</label>
                                <select id="ville" class="form-control">
                                    <option value="0">Choix de villes</option>
                                    <?php
                                    $villes = chercherVilles();
                                    foreach ($villes as $ville) {
                                        echo '<option value="' . htmlspecialchars($ville['id']) . '">'
                                            . htmlspecialchars($ville['nom_ville']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="role">Rôle</label>
                                <select id="role" class="form-control">
                                    <option value="0">Choix de rôle</option>
                                    <?php
                                    echo '<option value="client">Client</option>';
                                    if (isset($_SESSION['role'])) {
                                        if ($_SESSION['role'] == 'GERANT') {
                                            $idsDisponibles = chercherIdUserDispo();
                                            if (empty($idsDisponibles)) {
                                                echo '<option disabled>Aucun espace disponible pour ajouter un gérant</option>';
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
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Informations personnelles</h3>
                    <div class="validationList" id="resultList">
                        <ul class="validationUl" id="listResult">
                            <!-- Zone de validation -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("foots.infos.php"); ?>