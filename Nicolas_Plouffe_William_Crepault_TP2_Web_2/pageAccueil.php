<?php include("heads.infos.php"); ?>

<main>
  <h2>Bienvenue sur My Music Online</h2>
  <div class="container-fluid">
    <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
      <?php include("boutonsConDecon.infos.php"); ?>
    </div>
    <div class="row py-4">
      <div class="col-sm-12 col-lg-6">
        <div class="custom-border px-2">
          <h3>Informations</h3>
          <p>Vous êtes maintenant sur le site My Music Online. Selon votre rôle, vous avez
            accès à plusieurs fonctionnalités. Vous pouvez, grace aux liens de la barre
            de navigation ou les liens <span><b><a href="#menu" id="target">ci-joints</a></b></span>,
            afficher la listes des produits disponibles et ajouter des informations sur des
            albums de musique ou sur des artistes. De plus vous pouvez même ajouter des
            informations sur une oeuvre en particulier.</p>
          <p> Bonne navigation!</p>
        </div>
      </div>
      <div class="col-sm-12 col-lg-6">
        <div class="custom-border px-2">
          <h3 id="menu">Faites votre sélection</h3>
          <div class="ulBtn">
            <ul class="bntListe">
              <li><a href="pageListeAlbums.php" class="styled-button">Listes des albums</a></li>
              <?php
                if (isset($_SESSION['role'])) {
                  if ($_SESSION['role'] == 'CLIENT' || $_SESSION['role'] == 'ADMIN') {
                    echo '<li><a href="pageAchat.php" class="styled-button">Passer un achat</a></li>';
                  }
                  elseif ($_SESSION['role'] == 'GERANT') {
                    echo '<li><a href="pageArtiste.php" class="styled-button">Ajouter un artiste</a></li>';
                    echo '<li><a href="pageOeuvre.php" class="styled-button">Ajouter une oeuvre</a></li>';
                    echo '<li><a href="pageAlbum.php" class="styled-button">Ajouter un album</a></li>';
                  }
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