<?php include ("heads.infos.php"); ?>

    <main>
        <div class="container-fluid">
            <h2>Ajouter une nouvelle oeuvre</h2>
        </div>
        <div class="container-fluid">
            <div class="row py-4">
                <div class="col-sm-12 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Les champs avec <span class="red"><b>*</b></span> sont obligatoires</h3>
                        <form action="submit">
                            <div class="row py-2">
                                <div class="group-form col-sm-12 col-lg-6">
                                    <label for="pieceName"><span class="red"><b>*</b></span>Pièce</label>
                                    <input type="text" id="pieceName" class="form-control">
                                </div>
                                <div class="group-form col-sm-12 col-lg-6">
                                    <label for="artistName"><span class="red"><b>*</b></span>Artiste</label>
                                    <input type="text" id="artistName" class="form-control">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="roleOptions">Rôle</label>
                                    <select name="role" id="roleOptions" class="form-control">
                                        <option value="0">Rôle de l'artiste</option>
                                        <option value="1">Chanteur</option>
                                        <option value="2">Compositeur</option>
                                        <option value="3">Interprète</option>
                                        <option value="4">Auteur</option>
                                    </select>
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="timeInSec"><span class="red"><b>*</b></span>Temps (sec)</label>
                                    <input type="number" id="timeInSec" placeholder="max 999" min="0" step="15"
                                        class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="sizeMB">Taille (MB)</label>
                                    <input type="number" id="sizeMB" placeholder="max 999" min="0" step="0.5"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="albumValue"><span class="red"><b>*</b></span>Valeur ($)</label>
                                    <input type="number" id="albumValue" placeholder="0.00" min="0.95" step="1"
                                        class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="datePublication"><span class="red"><b>*</b></span>Publication</label>
                                    <input type="date" id="datePublication" class="form-control">
                                </div>
                                <div class="group-form col-md-6 col-lg-4">
                                    <label for="albumCode"><span class="red"><b>*</b></span>Code</label>
                                    <input type="text" id="albumCode" placeholder="AAA0000" class="form-control">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="group-form col-lg-6">
                                    <label for="youtubeLink">Lien Youtube</label>
                                    <input type="text" id="youtubeLink" class="form-control">
                                </div>
                                <div class="group-form col-lg-6">
                                    <label for="lyrics">Lyrics</label>
                                    <textarea name="lyrics" id="lyrics" cols="30" rows="5"
                                        class="form-control"></textarea>
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
                <div class="col-sm-12 col-lg-6">
                    <div class="custom-border px-2">
                        <h3>Informations sur l'oeuvre</h3>
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
    
    <?php include ("foots.infos.php"); ?> 