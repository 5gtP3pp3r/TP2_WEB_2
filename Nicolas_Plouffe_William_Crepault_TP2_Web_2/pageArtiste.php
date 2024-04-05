<?php include ("heads.infos.php"); ?>

  <main>
    <div class="container-fluid">
      <h2>Ajouter un nouvel artiste</h2>
    </div>
    <div class="container-fluid">
      <div class="row py-4">
        <div class="col-sm-12 col-lg-6">
          <div class="custom-border px-2">
            <h3>Tout les champs sont obligatoires</h3>
            <form action="submit">
              <div class="row">
                <div class="form-group col-md-12 col-lg-4">
                  <label for="idArtiste">Nom</label>
                  <input type="text" id="idArtiste" name="idArtiste" class="form-control">
                </div>
                <div class="form-group col-md-6 col-lg-4">
                  <label>Ville</label>
                  <select id="ville" class="form-control">
                    <option value="0" id="choixDefaut">Choix de ville</option>
                    <option value="1" id="NewYork">New York</option>
                    <option value="2" id="LosAngeles">Los Angeles</option>
                    <option value="3" id="Memphis">Memphis</option>
                    <option value="4" id="Chicago">Chicago</option>
                    <option value="5" id="Londre">Londre</option>
                    <option value="6" id="Paris">Paris</option>
                    <option value="7" id="Rome">Rome</option>
                    <option value="8" id="Montreal">Montreal</option>
                    <option value="9" id="Quebec">Quebec</option>
                    <option value="10" id="RioDeJaneiro">Rio de Janeiro</option>
                    <option value="11" id="Mexico">Mexico</option>
                    <option value="12" id="Tokyo">Tokyo</option>
                    <option value="13" id="Manchester">Manchester</option>
                    <option value="14" id="Liverpool">Liverpool</option>
                    <option value="14" id="Mumbai">Mumbai</option>
                    <option value="15" id="Sydney">Sydney</option>
                    <option value="16" id="Berlin">Berlin</option>
                  </select>
                </div>
                <div class="form-group col-md-6 col-lg-4">
                  <label for="photoArtiste">Photo</label>
                  <input type="text" id="photoArtiste" name="photoArtiste" class="form-control">
                </div>
                <div class="ulBtn">
                  <ul class="bntListe">
                    <li><button type="reset" id="resetUS1" class="styled-button">Effacer</button></li>
                    <li><button type="submit" id="submitUS1" class="styled-button">Enregistrer</button></li>
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
  
  <?php include ("foots.infos.php"); ?> 