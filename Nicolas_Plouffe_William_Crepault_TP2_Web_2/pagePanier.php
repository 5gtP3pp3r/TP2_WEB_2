<?php

if (!$_SESSION['role'] == 'CLIENT') {
    header("Location: index.php");
} else {

    include("heads.infos.php");
    require_once "fichiersPHP/connexionBD.php";
    require_once "fichiersPHP/Panier.class.php";

    $afficherPanier = isset($_SESSION["panier_oeuvre"]) && !empty($_SESSION["panier_oeuvre"]);
    $achatReussi = false;

    if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "remove":
                if ($afficherPanier) {
                    $monPanier = unserialize($_SESSION['panier_oeuvre']);
                    if (isset($_GET['id_oeuvre'])) {
                        $oeuvre = chercherOeuvre($_GET["id_oeuvre"])[0];
                        $monPanier->deleteItem($oeuvre);
                        if ($monPanier->isEmpty()) {
                            unset($_SESSION["panier_oeuvre"]);
                            $afficherPanier = false;
                        } else {
                            $_SESSION['panier_oeuvre'] = serialize($monPanier);
                        }
                    } else {
                        echo "ID de l'œuvre non spécifié.";
                    }
                }
                break;
            case "empty":
                unset($_SESSION["panier_oeuvre"]);
                $afficherPanier = false;
                break;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'ajouterCommande') {
        if ($afficherPanier) {
            $monPanier = unserialize($_SESSION['panier_oeuvre']);
            $achatReussi = ajouterCommande($monPanier);
            if ($achatReussi) {
                unset($_SESSION["panier_oeuvre"]);
                $_SESSION["achat_reussi"] = "Votre commande est en traitement. Merci pour votre achat!";
                header("Location: pagePanier.php");
                exit;
            }
        }
    }
?>
    <main>
        <h2>Passer un achat</h2>
        <div class="container-fluid">
            <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
                <?php include("boutonsConDecon.infos.php"); ?>
            </div>
            <div class="row py-4">
                <div class="col-sm-12 mb-3 col-lg-8">
                    <div class="custom-border px-2">
                        <h3>Mes Articles:</h3>
                        <?php
                        if (isset($_SESSION["achat_reussi"])) {
                        ?>
                            <div class="row py-2">
                                <div class="col-sm-12 col-md-9 d-flex justify-content-end mb-3">
                                    <h3 class="text-success"><?= $_SESSION["achat_reussi"] ?></h3>
                                </div>
                                <div class="col-sm-12 col-md-3 d-flex justify-content-center mb-3">
                                    <img src="Images/enveloppe.png" alt="enveloppe">
                                </div>
                            </div>
                            <?php unset($_SESSION["achat_reussi"]); ?>
                            <?php } else if ($afficherPanier) {

                            $monPanier = unserialize($_SESSION['panier_oeuvre']);
                            $listItems = $monPanier->getItems();
                            $total_quantite = 0;
                            $total_prix = 0;

                            foreach ($listItems as $article) {
                                $oeuvreChoisi = $article["item"];
                                $items_prix = $article["qty"] * $oeuvreChoisi->getPrix();
                                $total_quantite += $article["qty"];
                                $total_prix += $items_prix;
                            ?>
                                <div class="row py-2">
                                    <div class="col-md-4 col-lg-2 d-flex align-items-center justify-content-center">
                                        <img src="Images/<?php echo htmlspecialchars($oeuvreChoisi->getAlbumImg()); ?>" alt="<?php echo htmlspecialchars($oeuvreChoisi->getAlbumImg()); ?>" class="resize img-fluid rounded">
                                    </div>
                                    <div class="col-md-4 col-lg-4 d-flex align-items-center justify-content-center">
                                        <p><b>Titre:&nbsp;</b><?php echo htmlspecialchars($oeuvreChoisi->getTitreOeuvre()); ?></p>
                                    </div>
                                    <div class="col-md-4 col-lg-2 d-flex justify-content-center px-0">
                                        <p><b>Prix:&nbsp;</b><?php echo htmlspecialchars($oeuvreChoisi->getPrix()); ?>.00$</p>
                                    </div>
                                    <div class="col-md-12 col-lg-4 px-2">
                                        <form action="pagePanier.php?action=remove&id_oeuvre=<?php echo $oeuvreChoisi->getIdOeuvre(); ?>" method="post" class="d-flex align-items-end justify-content-center">
                                            <p style="margin-right: 25px;"><b>Quantité: </b><?php echo $article["qty"]; ?></p>
                                            <button type="submit" id="retirerPanier" class="styled-button" style="width: 140px;"><img src="Images/retirer_panier.png" alt="retirer panier"> Retirer</button>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>
                            <div>
                                <h3>Total achat: <?php echo number_format($total_prix, 2); ?>$</h3>
                                <div class="d-flex justify-content-center mb-3">
                                    <form action="pagePanier.php" method="post">
                                        <input type="hidden" name="action" value="ajouterCommande">
                                        <button type="submit" class="styled-button">Passer la commande</button>
                                    </form>
                                </div>
                            </div>
                        <?php } else { ?>
                            <div>
                                <h3>Votre panier est vide</h3>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-sm-12 mb-3 col-lg-4">
                    <div class="custom-border px-2">
                        <h3 id="menu">Mon panier:&nbsp;&nbsp;</h3>
                        <div class="ulBtn">
                            <form action="pagePanier.php?action=empty" method="post">
                                <ul class="bntListe">
                                    <li><button type="submit" id="videPanier" class="styled-button"><img src="Images/vider_panier.png" alt="vider_panier"> Vider</button></li>
                                    <li><button type="button" id="retourAchat" class="styled-button">Retour achat</button> </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

<?php include("foots.infos.php"); } ?>