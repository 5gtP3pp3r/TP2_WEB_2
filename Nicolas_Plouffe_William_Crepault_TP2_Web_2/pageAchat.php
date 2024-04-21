<?php

include("heads.infos.php");
include("fichiersPHP/connexionBD.php");
include("fichiersPHP/Oeuvre.class.php");
try {
    
    if (!empty($_GET["action"])) {
        switch ($_GET["action"]) {
            case "add":
                if (!empty($_POST["quantity"])) {

                    $item = chercherOeuvre($_GET["id_oeuvre"])[0];

                    if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
                        $monpanier = unserialize($_SESSION["cart_item"]);
                        $monpanier->addItem($item, $_POST["quantity"]);
                        $_SESSION['cart_item'] = serialize($monpanier);
                    } else {
                        $monpanier = new Panier();
                        $monpanier->addItem($item, $_POST["quantity"]);
                        $_SESSION['cart_item'] = serialize($monpanier);
                    }
                }
                break;
            case "empty":
                unset($_SESSION["cart_item"]);
                break;
        }
    }
} catch (Exception $e) {
    $res = '<div id="err" class="alert alert-danger">' . $res . $e->getMessage() . "</div>";
}
?>

<main>
    <h2>Passer un achat</h2>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-8">
                <div class="custom-border px-2">
                    <h3>Oeuvres disponibles:</h3>
                    <div>
                        <?php
                        $product_array = chercherOeuvre("-1");
                        if (!empty($product_array)) {
                            foreach ($product_array as $oeuvre) {
                        ?>
                            <div class="row py-3">
                                <div class="col-sm-12 col-md-4 col-lg-3"><span><b>Code album: </b></span><?php echo $oeuvre->getCodeAlbum() ?></div>
                                <div class="col-sm-12 col-md-4 col-lg-3"><span><b>Titre: </b></span><?php echo $oeuvre->getTitreOeuvre() ?></div>
                                <div class="col-sm-12 col-md-4 col-lg-2"><span><b>Prix: </b></span><?php echo $oeuvre->getPrix() ?><span>$</span></div>
                                <div class="col-sm-12 col-md-12 col-lg-4">
                                    <form action="pageAchat.php?action=add&id_oeuvre=<?php echo $oeuvre->getIdOeuvre() ?>" method="post" class="d-flex align-items-center">
                                        <input type="number" name="quantity" value="1" min="1" max="10" class="form-control mr-2" style="width: 100px;">
                                        <button type="button" id="ajoutPanier" class="styled-button"><img src="Images/ajout_panier.png" alt="ajouter panier"> ajouter panier</button>
                                    </form>
                                </div>
                            </div>
                        <?php }} ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="custom-border px-2">
                    <h3 id="menu">Voir mon panier:</h3>
                    <div class="col-sm-12 d-flex justify-content-center px-4 py-2">
                        <?php
                        if (isset($_SESSION["cart_item"])) {
                            $total_quantity = 0;
                            $total_price = 0;

                            if (!empty($_SESSION["cart_item"])) {
                                $monpanier = unserialize($_SESSION['cart_item']);

                                $qt = $monpanier->getCountItems();
                                echo '<button type="button" id="panier" class="styled-button"><img src="Images/panier.png" 
                                     alt="panier">&nbsp;&nbsp;' . $qt . ' articles</button>';
                            }
                        } else
                            echo '<button type="button" id="panier" class="styled-button"><img src="Images/panier.png" 
                        alt="panier">&nbsp;&nbsp; article</button>';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php include("foots.infos.php"); ?>