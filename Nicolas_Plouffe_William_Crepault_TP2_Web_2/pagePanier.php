<?php
include("heads.infos.php");
require_once "fichiersPHP/connexionBD.php";
require_once "fichiersPHP/Panier.class.php";

if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                $monPanier = unserialize($_SESSION['cart_item']);


                if (isset($_GET['id_oeuvre'])) {
                    $oeuvre = chercherOeuvre($_GET["id_oeuvre"])[0];
                    $monPanier->deleteItem($oeuvre);
                    if ($monPanier->isEmpty())
                        unset($_SESSION["cart_item"]);
                    else
                        $_SESSION['cart_item'] = serialize($monPanier);
                } else {
                    echo "ID de l'œuvre non spécifié.";
                }
                $monPanier->deleteItem($oeuvre);

                if ($monPanier->isEmpty())
                    unset($_SESSION["cart_item"]);
                else
                    $_SESSION['cart_item'] = serialize($monPanier);
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
    }
} ?>
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
                    if (isset($_SESSION["cart_item"])) {
                        $total_quantity = 0;
                        $total_price = 0;

                        if (!empty($_SESSION["cart_item"])) {
                            $monPanier = unserialize($_SESSION['cart_item']);
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
                                        <img src="Images/<?php echo $oeuvreChoisi->getAlbumImg() ?>" alt="<?php echo $oeuvreChoisi->getAlbumImg() ?>" class="resize img-fluid rounded">
                                    </div>
                                    <div class="col-md-4 col-lg-4 d-flex align-items-center justify-content-center">
                                        <p><b>Titre:&nbsp;</b><?php echo $oeuvreChoisi->getTitreOeuvre(); ?></p>
                                    </div>
                                    <div class="col-md-4 col-lg-2 d-flex justify-content-center px-0">
                                        <p><b>Prix:&nbsp;</b><?php echo $oeuvreChoisi->getPrix() ?>.00$</p>
                                    </div>
                                    <div class="col-md-12 col-lg-4 px-2">
                                    <form action="pagePanier.php?action=remove&id_oeuvre=<?php echo $oeuvreChoisi->getIdOeuvre() ?>" method="post" class="d-flex align-items-end justify-content-between">
                                        <p><b>Quantité: </b><?php echo $article["qty"]; ?></p>
                                        <button type="submit" id="retirerPanier" class="styled-button"><img src="Images/retirer_panier.png" alt="retirer panier">Retirer panier</button>
                                        </form>
                                    </div>
                                </div>
                                <?php } } ?>
                    <div>
                        <h5><?php echo "Total achat: " . number_format($total_prix, 2) . "$"; ?></h5>
                        <button class="styled-button">Passer la commande</button>
                        </div>   
                    <?php } else { ?>
                <div><h3>Votre panier est vide</h3></div>
            <?php }var_dump($monPanier); /* temp placé ici */ajouterCommande($monPanier); ?>                     
                </div>  
            </div>                        
            <div class="col-sm-12 mb-3 col-lg-4">
                <div class="custom-border px-2">
                    <h3 id="menu">Mon panier:&nbsp;&nbsp;</h3>
                    <div class="ulBtn">
                        <form action="pagePanier.php?action=empty" method="post">
                        <ul class="bntListe">
                            <li><button type="submit" id="videPanier" class="styled-button"><img src="Images/retirer_panier.png" 
                                        alt="retirer_panier"> Vider panier</button></li>
                            <li><button type="button" id="retourAchat" class="styled-button">Retour achat</button>  </li>
                        </ul>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>   
</main>


<?php include("foots.infos.php"); ?>