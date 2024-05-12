<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
include("heads.infos.php");
?>

<h2>Bienvenue sur My Music Online</h2>
<div class="container-fluid">
  <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
    <?php include("boutonsConDecon.infos.php"); ?>
  </div>
  <div class="row py-4">
    <div class="col-sm-12 mb-3 col-lg-6">
      <div class="custom-border px-2">
        <h3>Informations</h3>
        <?php
        if (isset($_SESSION['role'])) {

          if ($_SESSION['role'] == 'CLIENT') {
        ?>
            <p>En tant que client, vous avez
              accès à quelques fonctionnalités. Vous pouvez, grace aux liens de la barre
              de navigation ou les liens <span><b><a href="#menu" id="target">ci-joints</a></b></span>,
              afficher la listes des produits disponibles ou acheter des oeuvres.</p>
          <?php
          } elseif ($_SESSION['role'] == 'GERANT') {
          ?>
            <p>En tant que gérant, vous avez
              accès à plusieurs fonctionnalités. Vous pouvez, grace aux liens de la barre
              de navigation ou les liens <span><b><a href="#menu" id="target">ci-joints</a></b></span>,
              afficher la listes des produits disponibles, ajouter un artiste, ajouter une oeuvre ou
              ajouter un album.</p>
          <?php
          } elseif ($_SESSION['role'] == 'ADMIN') {
          ?>
            <p>En tant qu'administrateur, vous avez
              accès à toutes les fonctionnalités afin de pouvoir tout tester. 
              Vous pouvez, grace aux liens de la barrede navigation ou les liens 
              <span><b><a href="#menu" id="target">ci-joints</a></b></span>,
              afficher la listes des produits disponibles, ajouter un artiste, ajouter une oeuvre ou
              ajouter un album. Vous pouvez aussi ajouter d'autres utilisateur.</p>
          <?php
          }
        } else {
          ?>
          <p>Vous êtes maintenant sur le site My Music Online. Est ce votre première visite?
            Vous pouvez consulter la liste des albums disponibles via la barre de navigation ou le lien
            <span><b><a href="#menu" id="target">ci-joint</a></b></span>. Pour acheter une oeuvre,
            veuillez vous enregister comme client.
          <?php
        }
          ?>
          <p> Bonne navigation!</p>
      </div>
    </div>
    <div class="col-sm-12 mb-3 col-lg-6">
      <div class="custom-border px-2">
        <h3 id="menu">Faites votre sélection</h3>
        <div class="ulBtn">
          <ul class="bntListe">
            <li><a href="pageListeAlbums.php" class="styled-button">Liste des albums</a></li>
            <?php
            if (isset($_SESSION['role'])) {
              if ($_SESSION['role'] == 'CLIENT') {
            ?>
                <li><a href="pageAchat.php" class="styled-button">Passer un achat</a></li>
              <?php
              } elseif ($_SESSION['role'] == 'GERANT' || $_SESSION['role'] == 'ADMIN') {
              ?>
                <li><a href="pageArtiste.php" class="styled-button">Ajouter un artiste</a></li>
                <li><a href="pageOeuvre.php" class="styled-button">Ajouter une oeuvre</a></li>
                <li><a href="pageAlbum.php" class="styled-button">Ajouter un album</a></li>
            <?php
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