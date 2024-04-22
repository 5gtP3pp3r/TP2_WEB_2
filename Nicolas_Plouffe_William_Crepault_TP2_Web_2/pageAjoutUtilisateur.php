<?php
include("heads.infos.php");
include('fichiersPHP/connexionBD.php');

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST['nomUtilisateur'])) {
        $errors[] = "Le nom d'utilisateur est requis.";
    } elseif (!preg_match('/^[a-zA-Z0-9]{3,45}$/', $_POST['nomUtilisateur'])) {
        $errors[] = "Le nom d'utilisateur doit contenir entre 6 et 45 caractères alphanumériques.";
    }

    $age = $_POST['age'] ?? null;
    if (empty($age)) {
        $errors[] = "L'âge est requis.";
    } elseif ($age < 18 || $age > 100) {
        $errors[] = "L'âge doit être entre 18 et 100 ans.";
    }

    if (empty($_POST['email'])) {
        $errors[] = "L'email est requis.";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "L'email n'est pas valide.";
    }

    if (empty($_POST['password'])) {
        $errors[] = "Le mot de passe est requis.";
    } elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/', $_POST['password'])) {
        $errors[] = "Le mot de passe doit contenir au moins 8 caractères, dont une lettre majuscule, une lettre minuscule, un chiffre et un caractère spécial.";
    }

    if (empty($_POST['ville']) || $_POST['ville'] == '0') {
        $errors[] = "Choix de ville requis.";
    }

    if (empty($_POST['role']) || $_POST['role'] == '0') {
        $errors[] = "Choix d'un rôle requis.";
    }

    if (count($errors) === 0) {

        $nom = $_POST['nomUtilisateur'];
        $email = $_POST['email'];
        $motPasse = $_POST['password'];
        $motPasseHash = password_hash($motPasse, PASSWORD_DEFAULT);
        $role = $_POST['role'];
        $ville = $_POST['ville'];
        $age = $_POST['age'];

        $idDisponible = ($role === 'GERANT') ? $role : null;

        $resultat = ajoutUtilisateurBD($nom, $email, $motPasseHash, $ville, $age, $role);

        if ($resultat) {
            $successMessage = "Utilisateur enregistré avec succès !";
        } else {
            $errors[] = "Erreur lors de l'enregistrement dans la base de données.";
        }
    }
}
?>
<main>
    <?php
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'GERANT') {
            echo '<h1>Enregistrer un utilisateur</h1>';
        }
    } else {
        echo '<h1>S\'enregistrer</h1>';
    }
    ?>
    <div class="container-fluid">
        <div class="col-sm-12 py-2 d-flex justify-content-end px-4">
            <?php include("boutonsConDecon.infos.php"); ?>
        </div>
        <div class="row py-4">
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2 container-fluid">
                    <h3>Tout les champs sont obligatoires</h3>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row py-2">
                            <div class="col-sm-12 col-md-6">
                                <label for="nomUtilisateur">Nom d'utilisateur</label>
                                <input type="text" id="nomUtilisateur" name="nomUtilisateur" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="age">Age</label><Span> (18 ans et plus)</Span>
                                <input type="number" id="age" name="age" placeholder="max 100" min="18" step="1" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="email">Courriel</label>
                                <input type="email" id="email" name="email" placeholder="nom@domaine.com" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="password">Mot de passe</label>
                                <input type="password" id="password" name="password" class="form-control">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="ville">Ville</label>
                                <select id="ville" name="ville" class="form-control">
                                    <option value="0">Choix de villes</option>
                                    <?php
                                    $villes = chercherVilles();
                                    foreach ($villes as $ville) {
                                        echo '<option value="' . htmlspecialchars($ville['id']) . '">'
                                            . htmlspecialchars($ville['nom_ville']) . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="role">Rôle</label>
                                <select id="role" name="role" class="form-control">
                                    <option value="0">Choix de rôle</option>
                                    <?php
                                    echo '<option value="client">Client</option>';
                                    if (isset($_SESSION['role'])) {
                                        if ($_SESSION['role'] == 'GERANT') {
                                            $idsDisponibles = chercherIdUserDispo();
                                            if (empty($idsDisponibles)) {
                                                echo '<option disabled>Aucun espace disponible pour ajouter un gérant</option>';
                                            } else {
                                                foreach ($idsDisponibles as $idDisponible) {
                                                    echo '<option value="' . $idDisponible . '">Gérant (ID: ' . $idDisponible . ')</option>';
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="ulBtn">
                                <ul class="bntListe">
                                    <li><button type="reset" id="resetUS0" class="styled-button">Effacer</button></li>
                                    <li><button type="submit" id="submitUS0" class="styled-button">Enregistrer</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-12 col-lg-6">
                <div class="custom-border px-2">
                    <h3>Informations personnelles</h3>
                    <div class="validationList" id="resultList">
                        <ul class="validationUl" id="listResult">
                            <!-- Zone de validation client -->
                            <?php
                            if (!empty($errors)) {
                                foreach ($errors as $error) {
                                    echo '<li class="text-danger">' . htmlspecialchars($error) . '</li>';
                                }
                            } elseif (isset($successMessage)) {
                                echo '<li class="text-success">' . htmlspecialchars($successMessage) . '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include("foots.infos.php"); ?>