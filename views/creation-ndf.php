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
$Date = $Price = $Reason = $Proof = $ID_EXPENSES_CLAIM_TYPE = "";
// Variables pour stocker les messages d'erreur
$DateError = $PriceError = $ReasonError = $ProofError = $ID_EXPENSES_CLAIM_TYPEError = "";
// Variable pour stocker le niveau de sécurité du mot de passe
$securityLevel = 0;
?>
<form class="formulaire" method="post" enctype="multipart/form-data">
  <!-- Formulaire poru entrer les informations de la note de frais -->
  <!-- Date -->
  <div class="mb-3">
    <label for="Date" class="form-label">Date</label>
    <input type="date" class="form-control" id="Date" name="Date" value="<?= $Date ?>">
    <small class="text-danger"><?= $DateError ?></small>
  </div>
  <!-- Prix -->
  <div class="mb-3">
    <label for="Price" class="form-label">Prix</label>
    <input type="text" class="form-control" id="Price" name="Price" value="<?= $Price ?>">
    <small class="text-danger"><?= $PriceError ?></small>
  </div>
  <!-- Raison -->
  <div class="mb-3">
    <label for="Reason" class="form-label">Raison</label>
    <input type="text" class="form-control" id="Reason" name="Reason" value="<?= isset($_POST['Reason']) ? htmlspecialchars($_POST['Reason']) : '' ?>">
    <small class="text-danger"><?= $ReasonError ?></small>
  </div>
  <!-- Preuve -->
  <div class="mb-3">
    <label for="Proof" class="form-label">Preuve</label>
    <input type="file" class="form-control" id="Proof" name="Proof" value="<?= $Proof ?>">
    <small class="text-danger"><?= $ProofError ?></small>
  </div>
  <!-- Select permettant de choisir le type de note de frais. On choisit entre "Frais de repas", "Frais de déplacement", "Frais d'hébergement", "Frais kilométriques" et "Frais d'habillage" -->
  <div class="mb-3">
    <label for="ID_EXPENSES_CLAIM_TYPE" class="form-label">Type de note de frais</label>
    <select class="form-select" id="ID_EXPENSES_CLAIM_TYPE" name="ID_EXPENSES_CLAIM_TYPE">
      <option value="" disabled selected>Choisir un type de note de frais</option>
      <option value="1">Frais de repas</option>
      <option value="2">Frais de déplacement</option>
      <option value="3">Frais d'hébergement</option>
      <option value="4">Frais kilométriques</option>
      <option value="5">Frais d'habillage</option>
    </select>
  </div>
  <div class="boutonslogin">
    <div class="divboutonaccueillogin">
      <!-- Bouton pour valider le formulaire -->
      <button type="submit" class="boutonaccueillogin">Valider</button>
    </div>
    <div class="divboutonaccueillogin">
      <!-- Bouton pour réinitialiser le formulaire -->
      <button type="reset" class="boutonaccueillogin">Réinitialiser</button>
    </div>
    <!-- Bouton pour annuler le formulaire -->
    <div class="divboutonaccueillogin">
      <button type="button" class="boutonaccueillogin" onclick="confirmCancel()">Annuler</button>
    </div>
  </div>
  <!-- Demande de confirmation avant d'annuler le formulaire -->
  <script>
    function confirmCancel() {
      if (confirm("Voulez-vous vraiment annuler le formulaire ?")) {
        window.location.href = "../controllers/controller-accueil.php";
      } else {
        return false;
      }
    }
  </script>
</form>
<?php include "components/footer.php" ?>