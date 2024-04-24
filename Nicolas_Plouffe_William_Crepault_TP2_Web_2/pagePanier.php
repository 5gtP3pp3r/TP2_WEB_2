<?php
include("heads.infos.php");
require_once "fichiersPHP/connexionBD.php";
require_once "fichiersPHP/Panier.class.php";



if (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                $monPanier = unserialize($_SESSION['cart_item']);
                // echo (" supprimer item code ".$_GET["code"]);
                $oeuvre = getProductsByCode($_GET["code"])[0];
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
            <div class="col-sm-12 col-lg-8">
                <div class="custom-border px-2">
                    <h3>Mes Articles:</h3>
                    <?php
                    if (isset($_SESSION["cart_item"])) {
                        $total_quantity = 0;
                        $total_price = 0;

                        if (!empty($_SESSION["cart_item"])) {
                            $monPanier = unserialize($_SESSION['cart_item']);
                            $listItems = $monPanier->getItems();
                            foreach ($listItems as $article) {
                                $oeuvreChoisi = $article["item"];

                                $items_price = $article["qty"] * $oeuvreChoisi->getPrix();
                    ?>
                        <div class="row py-3">
                                    <div class="col-sm-12 col-md-4 col-lg-2 d-flex align-items-center d-flex justify-content-center"><img src="Images/<?php echo $oeuvreChoisi->getAlbumImg() ?>" alt="<?php echo $oeuvreChoisi->getAlbumImg() ?>" class="resize"></div>
                                    <div class="col-sm-12 col-md-4 col-lg-4 d-flex align-items-center"><span>
                                            <b>Titre:&nbsp;</b></span><?php echo $oeuvreChoisi->getTitreOeuvre() ?></div>
                                    <div class="col-sm-12 col-md-4 col-lg-2 d-flex align-items-center"><span>
                                            <b>Prix:&nbsp;</b></span><?php echo $oeuvreChoisi->getPrix() ?><span>$</span></div>
                                    <div class="col-sm-12 col-md-12 col-lg-4">
                                        <form action="pagePanier.php?action=remove&id_oeuvre=<?php echo $oeuvreChoisi->getIdOeuvre() ?>" method="post" class="d-flex align-items-end">
                                            <input type="number" name="quantity" value="1" min="1" max="10" class="form-control mr-2" style="width: 100px;">
                                            <button type="submit" id="retirerPanier" class="styled-button"><img src="Images/retirer_panier.png" alt="retirer panier"> ajouter panier</button>
                                        </form>
                                    </div>
                                    <div class="d-flex flex-row align-items-center">
                                        <h5 class="mt-1 mr-1 ml-1 text-success"><?php echo $article["qty"]; ?></h5>
                                    </div>
                                    <div>
                                        <h5 class="text-primary"><?php echo "$ " . $oeuvreChoisi->getPrix(); ?></h5>
                                    </div>
                                    <div>
                                        <h5 class="text-primary"><?php echo "$ " . number_format($items_price, 2); ?></h5>
                                    </div>
                            <?php
                                $total_quantity += $article["qty"];
                                $total_price += ($article["qty"] * $oeuvreChoisi->getPrix());
                            }
                        }
                            ?>
                        </div>    
                    </div>
                </div>
            </div>
        <?php
                    } else {
        ?>
            <h3>Votre panier est vide</h3>
        <?php }
        ?>
        </div>

        <div class="col-sm-12 col-lg-4">
            <div class="custom-border px-2">
                <h3 id="menu">Mon panier:&nbsp;&nbsp;</h3>
                <div class="col-sm-12 d-flex justify-content-center px-4 py-2">
                    <?php
                    echo '<button type="button" id="panier" class="styled-button"><img src="Images/retirer_panier.png" 
                             alt="retirer_panier"> vider panier</button>'
                    ?>
                </div>

            </div>
        </div>
    </div>
    </div>
    </div>
</main>


<?php include("foots.infos.php"); ?>