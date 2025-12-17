<?php require 'partials/header.php'; ?>

<h3>Taux de panne</h3>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>ID Véhicule</th>
      <th>Jours travaillés</th>
      <th>Jours panne</th>
      <th>Taux (%)</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= $row['vehicule'] ?></td>
        <td><?= $row['nbJourTravaille'] ?></td>
        <td><?= $row['nbPanne'] ?></td>
        <td><?= $row['tauxPanne'] ?> %</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

