<?php 
    include("heads.infos.php"); 
    //require_once("ConnectionDB.php");
?>

<main>
    <h2>Passer un achat</h2>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Oeuvres disponibles:</h3>
                </div>

            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3 id="menu">Voir mon panier:&nbsp;&nbsp;</h3>
                    <div class="col-sm-12 d-flex justify-content-end px-4 py-2">
                        <?php
                        $qt = 1;
                        echo '<button type="button" id="panier" class="styled-button"><img src="Images/panier.png" 
                             alt="panier">&nbsp;&nbsp;' . $qt . ' article(s)</button>'
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</main>
<?php include("foots.infos.php"); ?>