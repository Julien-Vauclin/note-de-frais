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
                </form>
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