<?php include("heads.infos.php"); ?>

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
                    <form action="submit">
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
                                <input type="date" id="dateAjout" name="date" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="genreMusical">Genre</label>
                                <select id="genreMusical" class="form-control">
                                    <option value="0" id="GenreMusical">Genre</option>
                                    <option value="1" id="Pop">Pop</option>
                                    <option value="2" id="Rock">Rock</option>
                                    <option value="3" id="Blues">Blues</option>
                                    <option value="4" id="Jazz">Jazz</option>
                                    <option value="5" id="Classique">Classique</option>
                                    <option value="6" id="Folk">Folk</option>
                                    <option value="7" id="Electro">Electro</option>
                                    <option value="8" id="Latin">Latin</option>
                                    <option value="9" id="Opera">Opéra</option>
                                    <option value="10" id="Country">Country</option>
                                    <option value="11" id="HipHop">Hip-Hop</option>
                                    <option value="12" id="RnB">RnB</option>
                                    <option value="13" id="Funk">Funk</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="photo">Photo</label>
                                <input type="text" id="photo" name="photo" class="form-control">
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
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("foots.infos.php"); ?>