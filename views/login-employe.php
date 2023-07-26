<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p class="portailemploye">PAGE LOGIN EMPLOYE</p>
<!-- Bouton accueil -->
<div class="../retouraccueilinscription">
  <a href="controller-accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>
<!-- Fonction recuperation données formulaire -->
<script>
  function validateConnexion() {
    // Récupération des valeurs des champs du formulaire
    var lastname = document.getElementById('lastname').value;
    var firstname = document.getElementById('firstname').value;
    var mail = document.getElementById('mail').value;
    var password = document.getElementById('password').value;

    // Définition des regex
    var regexMail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]{2,}\.[a-z]{2,4}$/;

    // Validation des regex pour chaque champ
    if (!regexMail.test(mail)) {
      alert("L'adresse mail est invalide.");
      return false; // Empêche l'envoi du formulaire
    }
    // Si toutes les validations sont réussies, le formulaire peut être soumis normalement
    return true;
  }
</script>
<!-- Formulaire de connexion employé -->
<form class="formulaire" action="" method="post">
  <!-- Adresse mail -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Adresse e-mail</label>
    <input type="email" class="form-control" id="mail" aria-describedby="emailHelp" name="mail">
  </div>
  <!-- Mot de passe -->
  <label for="motdepasse" class="form-label">Mot de passe</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)" name="password">
    <span class="input-group-text"><i class="bi bi-eye-fill" onclick="afficherPassword()"></i></span>
  </div>
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
  <script>
    function connexionemploye() {
      window.location.href = "../controllers/controller-espace-employe.php";
    }
  </script>
  <!-- Boutons connexion & inscription -->
  <div class="boutonslogin">
    <!-- Bouton connexion -->
    <div class="boutonconnexionemploye">
      <button class="connexionemploye" type="submit" name="submit">Connexion</button>
    </div>
    <!-- Bouton inscription -->
    <div class="boutoninscriptionemploye">
      <a href="../controllers/controller-inscription.php">
        <button type="button" class="inscriptionemploye">Inscription</button>
      </a>
      <p class="pasdecompte">Vous n'avez pas de compte ?</p>
    </div>
  </div>
</form>
<?php include "components/footer.php" ?>