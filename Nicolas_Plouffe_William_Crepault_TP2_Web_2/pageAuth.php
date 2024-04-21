<?php

include('fichiersPHP/connexionBD.php');

if (session_id() == "") {
    session_start();
}

if (isset($_SESSION['user'])) {   
    header("Location: pageAccueil.php");
    exit();
}

if (isset($_POST["password"]) && isset($_POST["email"])) {
    $motPasse = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);

    try {
        $usr = chercherUser($motPasse, $email);
        if ($usr !== null) {
            $_SESSION['user'] = serialize($usr);
            $_SESSION['role'] = $usr['urRole'];
            header("Location: pageAccueil.php");
            exit();
        } else {
            $rep = 'Courriel ou mot de passe incorrect.';
        }
    } catch (Exception $e) {
        $rep = $e->getMessage();
    }
}
include("heads.infos.php");

?>

<main>
    <h2>Authentification</h2>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Tout les champs sont obligatoires</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="col-md-8">
                            <label for="email">Adresse mail</label>
                            <input type="email" id="email" name="email" class="form-control">
                        </div>
                        <div class="col-sm-12 col-md-8">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                        <div class="ulBtn">
                            <ul class="bntListe">
                                <li><button type="reset" id="resetUS0" class="styled-button">Effacer</button></li>
                                <li><button type="submit" id="submitUS0" class="styled-button">Enregistrer</button>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Informations personnelles</h3>
                    <div class="validationList" id="resultList">
                        <ul class="validationUl" id="listResult">
                            <!-- Zone de validation client-->
                        </ul>
                        <div class="d-flex justify-content-center">
                            <?php if (isset($rep) && !empty($rep)) {
                                echo "<p class='text-center text-danger'>$rep</p>";
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("foots.infos.php"); ?>