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
            <th scope="col">Motif</th>
            <th scope="col">Trajet</th>
            <th scope="col">Km</th>
            <th scope="col">Coût péage</th>
            <th scope="col">Coût repas</th>
            <th scope="col">Coût hébergement</th>
            <th scope="col">Total</th>
            <th scope="col">Modifier</th>
            <th scope="col">Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($ndf as $ndf) : ?>
            <tr>
              <td><?= $ndf['date'] ?></td>
              <td><?= $ndf['motif'] ?></td>
              <td><?= $ndf['trajet'] ?></td>
              <td><?= $ndf['km'] ?></td>
              <td><?= $ndf['cout_peage'] ?></td>
              <td><?= $ndf['cout_repas'] ?></td>
              <td><?= $ndf['cout_hebergement'] ?></td>
              <td><?= $ndf['total'] ?></td>
              <td><a href="../controllers/controller-modification-ndf.php?id=<?= $ndf['id'] ?>"><button type="button" class="btn btn-primary">Modifier</button></a></td>
              <td><a href="../controllers/controller-suppression-ndf.php?id=<?= $ndf['id'] ?>"><button type="button" class="btn btn-danger">Supprimer</button></a></td>
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
<!-- Bouton créer note de frais -->
<div class="retouraccueilinscription">
  <a href="../controllers/controller-creation-ndf.php">
    <button type="button" class="boutoncreerndf">Créer une note<br>de frais</button>
  </a>
</div>
<!-- Récupération du mail et du password de l'employé -->
<?php include "components/footer.php" ?>