<?php 
    include("heads.infos.php"); 
    include 'connecxionBD.php';
?>

<main>
    <h2>Authentification</h2>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Tout les champs sont obligatoires</h3>
                    <form action="submit">
                        <div class="col-md-8">
                            <label for="nomUtilisateur">Nom d'utilisateur</label>
                            <input type="text" id="nomUtilisateur" name="nomUtilisateur" class="form-control">
                        </div>
                        <div class="col-md-8">
                            <label for="password">Mot de passe</label>
                            <input type="text" id="password" name="password" class="form-control">
                        </div>
                        <div class="ulBtn">
                            <ul class="bntListe">
                                <li><button type="reset" id="resetUS0" class="styled-button">Effacer</button></li>
                                <li><button type="submit" id="submitUS0" class="styled-button">Enregistrer</button>
                                </li>
                            </ul>
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