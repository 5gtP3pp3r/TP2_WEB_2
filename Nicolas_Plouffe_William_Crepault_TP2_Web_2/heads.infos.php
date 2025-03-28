<!DOCTYPE html>
<html lang="fr">
<!--**********Travail par William Crépault  et Nicolas Plouffe**********-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageNom = getPageNom(basename($_SERVER['PHP_SELF'])); ?></title>
    <link rel="icon" href="Images/headset_cartoon_droit.png">
    <link rel="stylesheet" href="style_css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100" id="top">
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
                <a class="navbar-brand me-5" href="pageAccueil.php"><b>
                        <h1><b>Menu principal</b></h1>
                    </b></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active ms-4 me-4" aria-current="page" href="pageListeAlbums.php"><b>Liste des albums disponibles</b></a></li>
                        <?php
                        if (isset($_SESSION['role'])) {
                            if ($_SESSION['role'] == 'CLIENT') {
                        ?>
                                <li class="nav-item"><a class="nav-link me-4" href="pageAchat.php"><b>Passer un achat</b></a></li>
                            <?php
                            } elseif ($_SESSION['role'] == 'GERANT' || $_SESSION['role'] == 'ADMIN') {
                            ?>
                                <li class="nav-item"><a class="nav-link me-4" href="pageArtiste.php">Ajouter un artiste</a></li>
                                <li class="nav-item"><a class="nav-link me-4" href="pageOeuvre.php">Ajouter une oeuvre</a></li>
                                <li class="nav-item"><a class="nav-link me-4" href="pageAlbum.php">Ajouter un album</a></li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <main class="flex-grow-1">
        <?php
        function getPageNom($page)
        {
            $page = explode(".", $page);
            return $page[0];
        }
        ?>