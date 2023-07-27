<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/Database.php"; ?>
<?php require_once "../controllers/controller-inscription.php"; ?>
<?php
// Variables pour stocker les valeurs des champs
$lastname = $firstname = $mail = $phone = $password = "";
// Variables pour stocker les messages d'erreur
$lastnameError = $firstnameError = $mailError = $phoneError = $passwordError = "";
// Validation des regex pour envoyer le formulaire
$securityLevel = 0;
// $allowSubmission = $messageNom = "" && $messagePrenom = "" && $messageMail = "" && $messageNumero = "" && $messagePassword = "";
?>
<p class="portailinscription">PAGE INSCRIPTION</p>
<!-- Bouton accueil -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>
<!-- Formulaire de connexion employé -->
<script>
  function validateForm() {
    // Récupération des valeurs des champs du formulaire
    var lastname = document.getElementById('lastname').value;
    var firstname = document.getElementById('firstname').value;
    var mail = document.getElementById('mail').value;
    var phone = document.getElementById('phone').value;
    var password = document.getElementById('password').value;
    var confirmationmotdepasse = document.getElementById('confirmationmotdepasse').value;

    // Définition des regex
    var regexLastname = /^[a-zA-Z]+$/;
    var regexFirstname = /^[a-zA-Z]+$/;
    var regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/;
    var regexPhone = /^(06|07)\d{8}$/;

    // Validation des regex pour chaque champ
    if (!regexLastname.test(lastname)) {
      alert("Le nom est invalide.");
      return false; // Empêche l'envoi du formulaire
    }

    if (!regexFirstname.test(firstname)) {
      alert("Le prénom est invalide.");
      return false; // Empêche l'envoi du formulaire
    }

    if (!regexMail.test(mail)) {
      alert("L'adresse mail est invalide.");
      return false; // Empêche l'envoi du formulaire
    }

    if (!regexPhone.test(phone)) {
      alert("Le numéro de téléphone est invalide.");
      return false; // Empêche l'envoi du formulaire
    }

    if (password !== confirmationmotdepasse) {
      alert("Les mots de passe ne correspondent pas.");
      return false; // Empêche l'envoi du formulaire
    }

    // Si toutes les validations sont réussies, le formulaire peut être soumis normalement
    return true;
  }
</script>
<!-- REGEX PHP -->
<?php
// Initialisation des variables
$invalid = '';
$messageNom = '';
$messagePrenom = '';
$messageMail = '';
$messageNumero = '';
$messagePassword = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $lastname = $_POST['lastname'];
  $firstname = $_POST['firstname'];
  $mail = $_POST['mail'];
  $phone = $_POST['phone'];
  $password = $_POST['password'];
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  $confirmationMotDePasse = $_POST['confirmationmotdepasse'];
  // Récupération des données du formulaire
  $nomInscrit = $_POST['lastname'];
  $prenomInscrit = $_POST['firstname'];
  $mailInscrit = $_POST['mail'];
  $numeroTelephone = $_POST['phone'];
  $motDePasse = $_POST['password'];
  $confirmationMotDePasse = $_POST['confirmationmotdepasse'];
  // Définition des regex
  $regexLastname = '/^[a-zA-Z-]+$/';
  $regexFirstname = '/^[a-zA-Z-]+$/';
  $regexMail = '/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/';
  $regexPhone = '/^(06|07)\d{8}$/';
  // Fonction lastname (regex)
  if ($nomInscrit === "") {
    $messageNom = "<p class='invalid'>Ce champ est obligatoire.</p>";
  } elseif (preg_match($regexLastname, $nomInscrit)) {
    $messageNom = "";
  } else {
    $messageNom = "<p class='invalid'>Le nom est invalide.</p>";
  };
  // Fonction firstname (regex)
  if ($prenomInscrit === "") {
    $messagePrenom = "<p class='invalid'>Ce champ est obligatoire.</p>";
  } elseif (preg_match($regexFirstname, $prenomInscrit)) {
    $messagePrenom = "";
  } else {
    $messagePrenom = "<p class='invalid'>Le prénom est invalide.</p>";
  };
  // Fonction mail (regex)
  if ($mailInscrit === "") {
    $messageMail = "<p class='invalid'>Ce champ est obligatoire.</p>";
  } elseif (preg_match($regexMail, $mailInscrit)) {
    $messageMail = "";
  } else {
    $messageMail = "<p class='invalid'>L'adresse mail est invalide.</p>";
  };
  // Fonction phone (regex)
  if ($numeroTelephone === "") {
    $messageNumero = "<p class='invalid'>Ce champ est obligatoire.</p>";
  } elseif (preg_match($regexPhone, $numeroTelephone)) {
    $messageNumero = "";
  } else {
    $messageNumero = "<p class='invalid'>Le numéro de téléphone est invalide.</p>";
  };
  // Fonction password
  if ($motDePasse !== $confirmationMotDePasse) {
    $messagePassword = "<p class='invalid'>Les mots de passe doivent être identiques.</p>";
  } else {
    // Vérification de la force du mot de passe (au moins "moyen")
    if (preg_match('/[a-z]/', $motDePasse)) {
      $securityLevel++;
    }
    if (preg_match('/[A-Z]/', $motDePasse)) {
      $securityLevel++;
    }
    if (preg_match('/[0-9]/', $motDePasse)) {
      $securityLevel++;
    }
    if (preg_match('/[@?!$]/', $motDePasse)) {
      $securityLevel++;
    }
    if (strlen($motDePasse) >= 8) {
      $securityLevel++;
    }
    if ($securityLevel == 0) {
      $messagePassword = "<p class='invalid'>Ce champ est obligatoire.</p>";
    } else if ($securityLevel < 2) {
      $messagePassword = "<p class='invalid'>Mot de passe trop dangereux.</p>";
    } else {
      $messagePassword = "";
    }
    if ($messageNom !== "" || $messagePrenom !== "" || $messageMail !== "" || $messageNumero !== "" || $messagePassword !== "") {
      echo "<p class='invalid'>Veuillez corriger les erreurs avant d'envoyer le formulaire.</p>";
    } else {
      try {
        $db = new Database();
        $pdo = $db->createInstancePDO();

        $sql = "SELECT COUNT(*) AS count FROM employee WHERE mail = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$mail]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['count'] > 0) {
          echo "<p class='invalid'>L'adresse e-mail existe déjà dans la base de données.</p>";
        } else {
          // Insertion dans la base de données
          $sql = "INSERT INTO employee (lastname, firstname, mail, phone, password) VALUES (?, ?, ?, ?, ?)";
          $stmt = $pdo->prepare($sql);
          $stmt->execute([$lastname, $firstname, $mail, $phone, $hashedPassword]);

          echo "L'employé a bien été ajouté. (inscription.php)";
          echo '<script>window.alert("Bienvenue ' . $firstname . ' ,vous êtes inscrit(e) !");
          window.location.href = "../controllers/controller-login-employe.php";
          </script>';
        }
      } catch (PDOException $exception) {
        echo "Erreur lors de l'ajout de l'employé : " . $exception->getMessage() . "<br>";
      }
    }
  }
}
?>
<form class="formulaire" method="post" onsubmit="return validateForm()">
  <!-- Nom -->
  <div class="mb-3">
    <label class="form-label">Nom</label>
    <input class="form-control" name="lastname" value="<?php echo htmlspecialchars($lastname) ?>">
    <?php echo $messageNom; ?>
  </div>
  <!-- Prénom -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Prénom</label>
    <input class="form-control" name="firstname" value="<?php echo htmlspecialchars($firstname) ?>">
    <?php echo $messagePrenom; ?>
  </div>
  <!-- Adresse mail -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="mail" value="<?php echo htmlspecialchars($mail) ?>">
    <?php echo $messageMail; ?>
  </div>
  <!-- Téléphone -->
  <div class="mb-3">
    <label for="phone" class="form-label">Téléphone</label>
    <input type="text" class="form-control" name="phone" id="phone" value="<?php echo htmlspecialchars($phone) ?>">
    <?php echo $messageNumero; ?>
  </div>
  <!-- Mot de passe -->
  <label for="motdepasse" class="form-label">Mot de passe</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="password">
    <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherPassword()"></i></span>
  </div>
  <?php echo $messagePassword; ?>
  <!-- Affichage mot de passe -->
  <script>
    function afficherPassword() {
      var x = document.getElementById("motdepasse");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <!-- Force mot de passe -->

  <div class="power" id="power">
    <div class="secure" id="secure"></div>
    <div class="message" id="message"></div>
  </div>
  <!-- Script -->
  <script>
    // variables
    var motdepasse = document.getElementById('motdepasse');
    var compteur = 0;
    var secure = document.getElementById('secure');
    // regex
    let regexMini = new RegExp('[a-z]');
    let regexMaj = new RegExp('[A-Z]');
    let regexNombre = new RegExp('[0-9]');
    let regexSpec = new RegExp('[@?!$]');
    // fonction taux de sécurité du mot de passe
    motdepasse.addEventListener('input', function() {
      let security = 0;
      if (regexMini.test(motdepasse.value)) {
        security++;
        console.log('Dangereux');
      }
      if (regexMaj.test(motdepasse.value)) {
        security++;
        console.log('Moyen');
      }
      if (regexNombre.test(motdepasse.value)) {
        security++;
        console.log('Sécurisé');
      }
      if (regexSpec.test(motdepasse.value)) {
        security++;
        console.log('Très sécurisé');
      }
      if (motdepasse.value.length >= 8) {
        security++;
        console.log('ULTRA SECURE');
      }
      console.log('security : ', security);
      // fonction changement texte
      if (security == 0) {
        secure.innerHTML = '<p>Inexistant</p>';
      } else if (security == 1) {
        secure.innerHTML = '<p style="color: red">Dangereux</p>';
      } else if (security == 2) {
        secure.innerHTML = '<p style="color: orange">Moyen</p>';
      } else if (security == 3) {
        secure.innerHTML = '<p style="color: gold">Sécurisé</p>';
      } else if (security == 4) {
        secure.innerHTML =
          '<p style="color: lime">Très sécurisé</p>';
      } else if (security == 5) {
        secure.innerHTML =
          '<p style="color: deeppink">Ultra sécurisé !</p>';
      }
    });
  </script>
  <!-- Confirmation mot de passe -->
  <label for="motdepasse" class="form-label">Confirmer le mot de passe</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="confirmationmotdepasse" aria-label="Amount (to the nearest dollar)" name="confirmationmotdepasse">
    <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherConfirmationPassword()"></i></span>
  </div>
  <!-- Confirmation mot de passe affichage-->
  <script>
    function afficherConfirmationPassword() {
      var x = document.getElementById("confirmationmotdepasse");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>
  <!-- Boutons connexion & inscription -->
  <div class="boutonslogin">
    <div class="divboutonaccueillogin">
      <a href="login-employe.php">
        <button type="button" class="boutonaccueillogin">Retour</button>
      </a>
    </div>
    <!-- Bouton inscription -->
    <div class="boutonconnexionemploye">
      <button type="submit" name="submit" class="sinscrire">S'inscrire</button>
    </div>
  </div>
</form>
<!-- fin formulaire -->
<?php include "components/footer.php" ?>