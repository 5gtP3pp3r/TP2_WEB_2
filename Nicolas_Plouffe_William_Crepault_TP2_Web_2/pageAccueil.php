<?php include ("heads.infos.php"); ?>

  <main>
    <h2>Bienvenue sur My Music Online</h2>
    <div class="container-fluid">
      <div class="row py-4">
        <div class="col-sm-12 col-lg-6">
          <div class="custom-border px-2">
            <h3>Informations</h3>
            <p>Vous êtes donc maintenant sur le site My Music Online. D'ici, vous avez accès
              à plusieurs fonctionnalités. Vous pouvez, grace aux liens de la barre
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
                <li><a href="pageListeAlbums.html" class="styled-button">Listes des albums</a></li>
                <li><a href="pageArtiste.html" class="styled-button">Ajouter un nouvel artiste</a></li>
                <li><a href="pageOeuvre.html" class="styled-button">Ajouter une nouvelle oeuvre</a></li>
                <li><a href="pageAlbum.html" class="styled-button">Ajouter un nouvel album</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <?php include ("foots.infos.php"); ?> 
