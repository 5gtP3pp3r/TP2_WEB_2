<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SESSION['role'] != 'GERANT') {
    header("Location: index.php");
} else {

    require_once 'fichiersPHP/validerOeuvre.php';
    include("heads.infos.php");    

    $resultats = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultats = validerOeuvre();
    }
?>

    <main>
        <h2>Ajouter une nouvelle oeuvre</h2>
        <div class="container-fluid">
            <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
                <?php include("boutonsConDecon.infos.php"); ?>
            </div>
            <div class="row py-4">
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Les champs avec <span class="red"><b>*</b></span> sont obligatoires</h3>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="row py-2">
                                <div class="group-form col-sm-12 col-lg-6">
                                    <label for="pieceName"><span class="red"><b>*</b></span>Pièce</label>
                                    <input type="text" id="pieceName" class="form-control" name="titrePiece">
                                </div>
                                <div class="group-form col-sm-12 col-lg-6">
                                    <label for="artistName"><span class="red"><b>*</b></span>Artiste</label>
                                    <select id="artistName" class="form-control" name="nomArtiste">
                                        <option value="0">Artiste</option>
                                        <?php chercherNomArtiste() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="roleOptions"><span class="red"><b>*</b></span>Rôle</label>
                                    <select name="role" id="roleOptions" class="form-control">
                                        <option value="0">Rôle de l'artiste</option>
                                        <?php chercherRoleArtiste() ?>
                                    </select>
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="timeInSec"><span class="red"><b>*</b></span>Temps (sec)</label>
                                    <input type="number" id="timeInSec" name="duree" placeholder="max 999" min="1" max="999" step="1" class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="sizeMB">Taille (MB)</label>
                                    <input type="number" id="sizeMB" name="taille" placeholder="max 999" min="1" max="999" step="1" class="form-control">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="albumValue"><span class="red"><b>*</b></span>Valeur ($)</label>
                                    <input type="number" id="albumValue" name="prix" min="1" max="10" step="1" class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="datePublication"><span class="red"><b>*</b></span>Publication</label>
                                    <input type="date" id="datePublication" name="datePublication" class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="albumCode"><span class="red"><b>*</b></span>Code</label>
                                    <select id="albumCode" name="codeAlbum" class="form-control">
                                        <option value="0">Code album</option>
                                        <?php chercherCodeAlbum() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-lg-12">
                                    <label for="lyrics">Lyrics</label>
                                    <textarea name="lyrics" id="lyrics" cols="30" rows="5" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="ulBtn">
                                <ul class="bntListe">
                                    <li><button type="reset" id="resetUS3" class="styled-button">Effacer</button></li>
                                    <li><button type="submit" id="submitUS3" class="styled-button">Enregistrer</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Informations sur l'oeuvre</h3>
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