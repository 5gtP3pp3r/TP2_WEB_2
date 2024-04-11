<!DOCTYPE html>
<html lang="fr">
<!--**********Travail par William Crépault  et Nicolas Plouffe**********-->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageName = getPageName(basename($_SERVER['PHP_SELF'])); ?></title>
    <link rel="icon" href="Images/headset_cartoon_droit.png">
    <link rel="stylesheet" href="style_css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body id="top">
    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="col-4 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="Images/headset_cartoon_gauche.png" alt="Bonhomme ecouteurs" class="img-fluid">
                </div>
                <div class="col-4 col-sm-4 col-md-8 text-center">
                    <h1><b>My Music Online</b></h1>
                </div>
                <div class="col-4 col-sm-4 col-md-2 d-flex justify-content-center">
                    <img src="Images/headset_cartoon_droit.png" alt="Bonhomme ecouteurs" class="img-fluid">
                </div>
                <div class="col-12 d-flex justify-content-center">
                    <img src="Images/portee_notes.png" alt="Portee de notes img-fluid">
                </div>
            </div>
        </div>
    </header>
    <nav>
        <div class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="pageAccueil.php"><b>
                        <h1>Menu principal</h1>
                    </b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="pageListeAlbums.php">&nbsp;&nbsp;&nbsp;Liste des albums disponibles</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageArtiste.php">&nbsp;&nbsp;&nbsp;Ajouter un nouvel artiste</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageOeuvre.php">&nbsp;&nbsp;&nbsp;Ajouter une nouvelle oeuvre</a></li>
                        <li class="nav-item"><a class="nav-link" href="pageAlbum.php">&nbsp;&nbsp;&nbsp;Ajouter un nouvel album</a></li>
                        <li class="nav-item"><a class="nav-link disabled" aria-disabled="true"></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <?php
    function getPageName($page)
    {
        $page = explode(".", $page);
        return $page[0];
    }
    ?>