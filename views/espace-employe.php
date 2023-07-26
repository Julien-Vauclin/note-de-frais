<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p class="portailemploye">Bienvenue <?= $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] ?></p>
<!-- Bouton accueil -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>
<!-- Bouton créer note de frais -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-creation-ndf.php">
    <button type="button" class="boutoncreerndf">Créer une note<br>de frais</button>
  </a>
</div>
<!-- Récupération du mail et du password de l'employé -->
<?php include "components/footer.php" ?>