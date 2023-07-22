<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p class="portailemploye">PAGE LOGIN EMPLOYE</p>
<!-- Formulaire de connexion employé -->
<form class="formulaire">
  <!-- Adresse mail -->
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Adresse mail</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <!-- Mot de passe -->
  <label for="motdepasse" class="form-label">Mot de passe</label>
  <div class="input-group mb-3">
    <input type="password" class="form-control" id="motdepasse" aria-label="Amount (to the nearest dollar)">
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
  <!-- Boutons connexion & inscription -->
  <div class="boutonslogin">
    <!-- Bouton connexion -->
    <div class="boutonconnexionemploye">
      <button type="submit" class="connexionemploye">Connexion</button>
    </div>
    <!-- Bouton inscription -->
    <div class="boutoninscriptionemploye">
      <a href="../views/inscription.php">
        <button type="button" class="inscriptionemploye">Inscription</button>
      </a>
      <p class="pasdecompte">Vous n'avez pas de compte ?</p>
    </div>
  </div>
</form>
<?php include "components/footer.php" ?>