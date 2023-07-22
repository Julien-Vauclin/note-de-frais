<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<?php
// Variables pour stocker les valeurs des champs
$nom = $couleur = $race = $espece = $age = $date_naissance = $date_arrivee = "";

// Variables pour stocker les messages d'erreur
$nom_err = $couleur_err = $race_err = $espece_err = $age_err = $date_naissance_err = $date_arrivee_err = "";

// Fonction de validation des champs avec des expressions régulières
function validerChamp($champ, $regex, &$valeur, &$erreur)
{
    if (!empty($champ)) {
        if (preg_match($regex, $champ)) {
            $valeur = $champ;
            return true;
        } else {
            $erreur = "Format invalide.";
        }
    } else {
        $erreur = "Ce champ est obligatoire.";
    }
    return false;
}


// Traitement du formulaire lors de la soumission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $regexForm = '/[?!;:\/.%$£*µ¨+\-\\~&"#|_ç@<>\[\]{}0-9]/';
        $input = $_POST["nom_animal"];
        if (preg_match($regexForm, $input)) {
            echo "Le champ contient des caractères non autorisés.";
        } else {
            echo "Le champ est conforme.";
        }
    }
    // Valider chaque champ avec les expressions régulières
    $nom_regex = "/^(?!.*(.)\1\1)[a-zA-Z]{3,}$/";
    $age_regex = "/^\d+$/";
    $date_naissance_regex = "/^\d{4}-\d{2}-\d{2}$/";
    $date_arrivee_regex = "/^\d{4}-\d{2}-\d{2}$/";
    validerChamp($_POST["nom_animal"], $nom_regex, $nom, $nom_err);
    validerChamp($_POST["date_naissance"], $date_naissance_regex, $date_naissance, $date_naissance_err);
    validerChamp($_POST["date_arrivee"], $date_arrivee_regex, $date_arrivee, $date_arrivee_err);
    // Si tous les champs sont valides, effectuer le traitement supplémentaire ici
    if (!empty($nom) && !empty($couleur) && !empty($race) && !empty($espece) && !empty($age) && !empty($date_naissance)) {
        // Traitement supplémentaire ici (par exemple, enregistrement dans une base de données)
        echo "Formulaire valide. Traitement en cours...";
        exit;
    }
}
?>
<div class="container">
    <h2>Réservation Spa</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <!-- Nom de l'animal -->
        <div class="mb-3 titreform">
            <label for="nom_animal" class="form-label">Nom de l'animal:</label>
            <input type="text" class="form-control" id="nom_animal" name="nom_animal" value="<?php echo isset($_POST['nom_animal']) ? htmlspecialchars($_POST['nom_animal']) : ''; ?>">
            <?php if (isset($nom_animal_err)) : ?>
                <div class="text-danger"><?php echo $nom_animal_err; ?></div>
            <?php endif; ?>
        </div>
        <!-- Date de naissance -->
        <div class="mb-3 titreform">
            <label for="date_naissance" class="form-label">Date de naissance:</label>
            <input type="date" class="form-control" id="date_naissance" name="date_naissance" value="<?php echo htmlspecialchars($date_naissance); ?>">
            <div class="text-danger"><?php echo $date_naissance_err; ?></div>
        </div>
        <!-- Date d'arrivée -->
        <div class="mb-3 titreform">
            <label for="date_arrivee" class="form-label">Date d'arrivée:</label>
            <input type="date" class="form-control" id="date_arrivee" name="date_arrivee" value="<?php echo htmlspecialchars(date('Y-m-d')); ?>">
            <div class="text-danger"><?php echo $date_arrivee_err; ?></div>
        </div>
        <!-- Select couleur -->
        <div class="mb-3 titreform">
            <select id="couleur" name="couleur">
                <option value="" disabled>Choisir une couleur</option>
                <option value="1" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'blanc') echo 'selected'; ?>>Blanc</option>
                <option value="2" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'noir') echo 'selected'; ?>>Noir</option>
                <option value="3" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'gris') echo 'selected'; ?>>Gris</option>
                <option value="4" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'brun') echo 'selected'; ?>>Brun</option>
                <option value="5" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'sable') echo 'selected'; ?>>Sable</option>
                <option value="6" <?php if (isset($_POST['couleur']) && $_POST['couleur'] === 'roux') echo 'selected'; ?>>Roux</option>
            </select>
        </div>

        <!-- Select espèce -->
        <div class="mb-3 titreform">
            <select id="select1" name="espece" onchange="updateSelect2()">
                <option value="" disabled>Choisir une espèce</option>
                <option value="1" <?php if (isset($_POST['espece']) && $_POST['espece'] === '1') echo 'selected'; ?>>Chien</option>
                <option value="2" <?php if (isset($_POST['espece']) && $_POST['espece'] === '2') echo 'selected'; ?>>Chat</option>
            </select>
        </div>

        <!-- Select race -->
        <div class="mb-3 titreform">
            <select id="select2" name="race">
                <option value="" disabled>Choisir une race</option>
                <option value="1" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === '1') echo 'selected'; ?>>Labrador</option>
                <option value="2" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === '2') echo 'selected'; ?>>Bulldog</option>
                <option value="3" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === '3') echo 'selected'; ?>>Caniche</option>
                <option value="4" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === '4') echo 'selected'; ?>>Chihuahua</option>
                <option value="5" data-group="1" <?php if (isset($_POST['race']) && $_POST['race'] === '5') echo 'selected'; ?>>Yorkshire</option>
                <option value="6" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === '6') echo 'selected'; ?>>Maine Coon</option>
                <option value="7" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === '7') echo 'selected'; ?>>Bengal</option>
                <option value="8" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === '8') echo 'selected'; ?>>Sphynx</option>
                <option value="9" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === '9') echo 'selected'; ?>>Siamois</option>
                <option value="10" data-group="2" <?php if (isset($_POST['race']) && $_POST['race'] === '10') echo 'selected'; ?>>Persan</option>
            </select>
        </div>
        <!-- Script qui adapte le select race en fonction du select espece -->
        <script>
            function updateSelect2() {
                var select1 = document.getElementById("select1");
                var select2 = document.getElementById("select2");

                var selectedValue = select1.value;

                // Réinitialiser le select2 à son état initial
                select2.innerHTML = "";

                // Ajouter les options en fonction de la sélection
                if (selectedValue === "1") {
                    var optionA = new Option("Labrador", "1");
                    var optionB = new Option("Bulldog", "2");
                    var optionC = new Option("Caniche", "3");
                    var optionD = new Option("Chihuahua", "4");
                    var optionE = new Option("Yorkshire", "5");

                    select2.add(optionA);
                    select2.add(optionB);
                    select2.add(optionC);
                    select2.add(optionD);
                    select2.add(optionE);
                } else if (selectedValue === "2") {
                    var optionF = new Option("Maine Coon", "6");
                    var optionG = new Option("Bengal", "7");
                    var optionH = new Option("Sphynx", "8");
                    var optionI = new Option("Siamois", "9");
                    var optionJ = new Option("Persan", "10");

                    select2.add(optionF);
                    select2.add(optionG);
                    select2.add(optionH);
                    select2.add(optionI);
                    select2.add(optionJ);
                }
            }
        </script>
        <!-- Bouton puce -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Pucé</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="funradio" value="1" <?php if (isset($_POST['funradio']) && $_POST['funradio'] === '1') echo 'checked'; ?>>
                    <label for="oui">Oui</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="funradio" value="0" <?php if (isset($_POST['funradio']) && $_POST['funradio'] === '0') echo 'checked'; ?>>
                    <label for="non">Non</label>
                </div>
            </div>
        </div>
        <!-- Bouton tatouage -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Tatoué</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="tattooradio" value="1" <?php if (isset($_POST['tattooradio']) && $_POST['tattooradio'] === '1') echo 'checked'; ?>>
                    <label for="oui">Oui</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="tattooradio" value="0" <?php if (isset($_POST['tattooradio']) && $_POST['tattooradio'] === '0') echo 'checked'; ?>>
                    <label for="non">Non</label>
                </div>
            </div>
        </div>
        <!-- Bouton sexe -->
        <div class="radiopuce text-start">
            <h3 class="titreform d-inline">Sexe</h3>
            <div class="divpuce d-inline">
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="ouiradio" name="radiosexe" value="1" <?php if (isset($_POST['radiosexe']) && $_POST['radiosexe'] === '1') echo 'checked'; ?>>
                    <label for="oui">Mâle</label>
                </div>
                <div class="boutonpuce ms-2 d-inline">
                    <input type="radio" id="nonradio" name="radiosexe" value="0" <?php if (isset($_POST['radiosexe']) && $_POST['radiosexe'] === '0') echo 'checked'; ?>>
                    <label for="non">Femelle</label>
                </div>
            </div>
        </div>
        <button type="submit" class="btn boutonform">Envoyer</button>
    </form>
</div>
<!-- Connexion à la base de données -->


<?php include "components/footer.php" ?>