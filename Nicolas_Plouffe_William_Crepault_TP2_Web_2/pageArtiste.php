<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] != 'GERANT') {
    header("Location: pageAccueil.php");
} else {

    include("heads.infos.php");
    require_once "fichiersPHP/validerArtistes.php";        

    $resultats = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultats = validerArtiste();
    }
?>

        <h2>Ajouter un nouvel artiste</h2>
        <div class="container-fluid">
            <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
                <?php include("boutonsConDecon.infos.php"); ?>
            </div>
            <div class="row py-4">
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Tout les champs sont obligatoires</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="row">
                                <div class="form-group col-md-12 col-lg-4">
                                    <label for="idArtiste">Nom</label>
                                    <input type="text" id="idArtiste" name="nomArtiste" class="form-control">
                                </div>
                                <div class="form-group col-md-6 col-lg-4">
                                    <label>Ville</label>
                                    <select id="ville" class="form-control" name="ville">
                                        <option value="0">Choix de ville</option>
                                        <?php chercherVilles(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-lg-4">
                                    <label for="photoArtiste">Photo</label>
                                    <input type="text" id="photoArtiste" name="photoArtiste" class="form-control">
                                </div>
                                <div class="ulBtn">
                                    <ul class="bntListe">
                                        <li><button type="reset" id="resetUS1" class="styled-button">Effacer</button></li>
                                        <li> <button type="submit" id="submitUS1" class="styled-button">Enregistrer</button>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Informations sur l'artiste</h3>
                        <div class="validationList" id="resultList">
                            <ul class="validationUl" id="listResult">
                                <!-- Zone de validation -->
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

<?php include("foots.infos.php");
} ?>