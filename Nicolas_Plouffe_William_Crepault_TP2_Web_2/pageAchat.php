<?php

include("heads.infos.php");
include("fichiersPHP/connexionBD.php");
include("fichiersPHP/Oeuvre.class.php");
try {
    $res = "";
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
                        <ul class="list-unstyled">
                            <?php
                            $product_array = chercherOeuvre("-1");
                            if (!empty($product_array)) {
                                foreach ($product_array as $oeuvre) {
                                    echo '<div class="row py-3">';
                                    echo '<div class="col-sm-12 col-md-4 col-lg-2"><span><b>Code album: </b></span>' . $oeuvre->getCodeAlbum() . '</div>';
                                    echo '<div class="col-sm-12 col-md-4 col-lg-2"><span><b>Titre: </b></span>' . $oeuvre->getTitreOeuvre() . '</div>';
                                    echo '<div class="col-sm-12 col-md-4 col-lg-2"><span><b>Prix: </b></span>' . $oeuvre->getPrix() . '<span>$</span></div>';
                                    echo '<div class="col-sm-12 col-md-12 col-lg-6">';
                                    echo '<form action="pageAchat.php?action=add&id_oeuvre=' . $oeuvre->getIdOeuvre() . '" method="post" class="d-flex align-items-center">';
                                    echo '<input type="number" name="quantity" value="1" min="1" max="10" class="form-control mr-2" style="width: 100px;">';
                                    echo '<button type="button" id="panier" class="styled-button"><img src="Images/retirer_panier.png" alt="retirer_panier"> vider panier</button>';
                                    echo '</form>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 col-lg-4">
                <div class="custom-border px-2">
                    <h3 id="menu">Voir mon panier:&nbsp;&nbsp;</h3>
                    <div class="col-sm-12 d-flex justify-content-center px-4 py-2">
                        <?php
                        if (isset($_SESSION["cart_item"])) {
                            $total_quantity = 0;
                            $total_price = 0;

                            if (!empty($_SESSION["cart_item"])) {
                                $monpanier = unserialize($_SESSION['cart_item']);

                                $nb = $monpanier->getCountItems();
                                echo '<button type="button" id="panier" class="styled-button"><img src="Images/panier.png" 
                                     alt="panier">&nbsp;&nbsp;' . $qt . ' articles</button>';
                            }
                        } else
                            echo '<button type="button" id="panier" class="styled-button"><img src="Images/panier.png" 
                        alt="panier">&nbsp;&nbsp; article</button>';
                        ?>
                        <?php
                        $qt = 1;

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php include("foots.infos.php"); ?>