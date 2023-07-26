<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<?php require_once "../config.php"; ?>
<?php require_once "../helpers/Database.php"; ?>
<?php require_once "../controllers/controller-creation-ndf.php"; ?>
<p class="portailemploye">PAGE CRÉATION NDF</p>
<!-- Bouton accueil -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>
<?php
// Variables pour stocker les valeurs des champs
$lastname = $firstname = $mail = $phone = $password = "";
?>
<?php include "components/footer.php" ?>