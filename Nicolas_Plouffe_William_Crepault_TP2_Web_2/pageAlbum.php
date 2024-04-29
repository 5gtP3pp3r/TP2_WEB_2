<?php

if (!$_SESSION['role'] == 'GERANT' || !$_SESSION['role'] == 'ADMIN') {
    header("Location: index.php");
}
else{

    include("heads.infos.php");
    require_once 'fichiersPHP/validerAlbum.php';
    require_once 'fichiersPHP/connexionBD.php';

    $resultats = null;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $resultats = ValiderAlbum();
    } ?>

    <main>
        <h2>Ajouter un nouvel album</h2>
        <div class="container-fluid">
            <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
                <?php include("boutonsConDecon.infos.php"); ?>
            </div>
            <div class="row py-4">
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Tout les champs sont obligatoires</h3>
                        <form action="pageAlbum.php" method="post">
                            <div class="row py-2">
                                <div class="col-md-8">
                                    <label for="titre">Titre</label>
                                    <input type="text" id="titre" name="titre" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="code">Code</label>
                                    <input type="text" id="code" name="code" placeholder="AAA0000" class="form-control">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-md-4">
                                    <label for="dateAjout">Ajout</label>
                                    <input type="date" id="dateAjout" name="dateAjout" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label for="genreMusical">Genre</label>
                                    <select id="genreMusical" name="genreMusical" class="form-control">
                                        <option value="0">Genre</option>
                                        <?php chercherMenuGenre(); ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label for="photo">Photo</label>
                                    <input type="text" id="photo" name="photo" placeholder="(.jpg .jpeg .png .gif .bmp)" class="form-control">
                                </div>
                                <div class="col-sm-12 col-md-10">
                                    <p>Une image 300 x 300 de l'album doit être ajoutée aux
                                        dossiers avant d'enregistrer un nouvel album. Si aucune image n'est
                                        disponible, S.V.P. utilisez le nom et l'extension de l'image suivante:
                                        "aucune_image.png"</p>
                                </div>
                                <div class="col-sm-12 col-md-2 d-flex align-items-center justify-content-center">
                                    <img src="Images/aucune_image.png" alt="aucune image" class="resize">
                                </div>
                            </div>
                            <div class="ulBtn">
                                <ul class="bntListe">
                                    <li><button type="reset" id="resetUS2" class="styled-button">Effacer</button></li>
                                    <li><button type="submit" id="submitUS2" class="styled-button">Enregistrer</button>
                                    </li>
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Informations sur l'album</h3>
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

    <?php include("foots.infos.php"); } ?>