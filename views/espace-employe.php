<?php include "components/head.php" ?>
<?php include "components/navbar.php" ?>
<p class="portailemploye">Bienvenue <?= $_SESSION['user']['firstname'] . " " . $_SESSION['user']['lastname'] ?></p>
<!-- On affiche les notes de frais de l'employé -->
<div class="container">
  <div class="row">
    <div class="col-12">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">Prix</th>
            <th scope="col">Motif</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach (ExpenseClaim::getAllExpensesClaim($_SESSION['user']['ID']) as $ndf) : ?>
            <tr>
              <td><?= $ndf['Date'] ?></td>
              <td><?= $ndf['Price'] . "€" ?></td>
              <td><?= $ndf['Reason'] ?></td>
              <!-- On affiche le bouton "supprimer" -->
              <td>
                <form action="" method="POST">
                  <input type="hidden" name="deleteID" value="<?= $ndf['ID'] ?>">
                  <input type="hidden" name="ownerID" value="<?= $ndf['ID_EMPLOYEE'] ?>">
                  <button type="submit" class="btn btn-danger">Supprimer</button>
                  <a href="../../Note-de-frais/controllers/controller-creation-ndf.php?date=<?= $ndf['Date'] ?>&price=<?= $ndf['Price'] ?>&reason=<?= $ndf['Reason'] ?>&proof=<?= $ndf['Proof'] ?>&claimType=<?= $ndf['ID_EXPENSES_CLAIM_TYPE'] ?>" class="btn btn-primary">Modifier</a>
                  <button type="button" id="afficherTableau" class="btn btn-primary">Afficher le tableau</button>
                  <!-- On affiche la note de frais sous forme de tableau -->
                  <table class="table table-striped" style="display: none;" id="myTable">
                    <thead>
                      <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Preuve</th>
                        <th scope="col">Type de note de frais</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?= $ndf['Date'] ?></td>
                        <td><?= $ndf['Price'] . "€" ?></td>
                        <td><?= $ndf['Reason'] ?></td>
                        <td><img src="data:image/jpeg;base64,<?= $ndf['Proof'] ?>" alt="Preuve" width="100px"></td>
                        <td><?= $ndf['ID_EXPENSES_CLAIM_TYPE'] ?></td>
                      </tr>
                    </tbody>
                  </table>
                </form>
                <!-- JAJA -->
                <script>
                  // Récupérer le bouton et le tableau
                  var bouton = document.getElementById("afficherTableau");
                  var tableau = document.getElementById("myTable");

                  // Ajouter un gestionnaire d'événement de clic au bouton
                  bouton.addEventListener("click", function() {
                    // Vérifier si le tableau est actuellement affiché ou masqué
                    if (tableau.style.display === "none") {
                      // Afficher le tableau en modifiant la propriété "display"
                      tableau.style.display = "table";
                      // Changer le texte du bouton en "Cacher le tableau"
                      bouton.textContent = "Cacher le tableau";
                    } else {
                      // Masquer le tableau
                      tableau.style.display = "none";
                      // Changer le texte du bouton en "Afficher le tableau"
                      bouton.textContent = "Afficher le tableau";
                    }
                  });
                </script>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- Bouton accueil -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-accueil.php">
    <button type="button" class="boutonaccueilinscription">Accueil</button>
  </a>
</div>
<!-- Bouton déconnexion -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-login-employe.php">
    <button type="button" class="boutondeconnexion">Déconnexion</button>
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