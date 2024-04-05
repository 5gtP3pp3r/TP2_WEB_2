<!DOCTYPE html>
<html lang="fr">
<!--**********Travail par William Crépault  et Nicolas Plouffe**********-->
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menue principal</title>
  <Link rel="icon" href="Images/headset_cartoon_droit.png">
  <link rel="stylesheet" href="style_css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body id="top">
  <header id="headerPlaceholder">
  </header>
  <nav id="navPlaceholder">
  </nav>
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
  <footer id="footerPlaceholder">
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="java_script/highlightBtn.js"></script>
  <script src="java_script/header_nav_footer.js"></script>
</body>

</html>