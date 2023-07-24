<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p class="portailemploye">ESPACE EMPLOYE</p>
<!-- Bouton accueil -->
<div class="retouraccueilinscription">
  <a href="accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>

<!-- Récupération du mail et du password de l'employé -->
<?php
$mail = $_POST['mail'];
$password = $_POST['password'];
?>
<?php include "components/footer.php" ?>