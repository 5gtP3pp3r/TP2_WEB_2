<?php include("heads.infos.php"); ?>

<main>
    <h2>Ajouter un nouvel artiste</h2>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Tout les champs sont obligatoires</h3>
                    <form method="POST">
                        <?php
            require_once('fichiersPHP/ajouterArtistes.php'); 
            testConnection();
            if ($_SERVER["REQUEST_METHOD"] == "POST") { // Si la méthode est POST on valide les champs, mais la validation ne fonctionne pas Comme si la M/thode Post n'était pas reconnue

              injectionArtiste();
            }



            ?>

                        <div class="row">
                            <div class="form-group col-md-12 col-lg-4">
                                <label for="idArtiste">Nom</label>
                                <input type="text" id="idArtiste" name="idArtiste" class="form-control">
                            </div>
                            <div class="form-group col-md-6 col-lg-4">
                                <label>Ville</label>
                                <select id="ville" class="form-control" name="ville">
                                    <?php
                  require_once('fichiersPHP/ajouterArtistes.php');
                  GestionMenuVille();
                  ?>

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
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Informations sur l'auteur</h3>
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