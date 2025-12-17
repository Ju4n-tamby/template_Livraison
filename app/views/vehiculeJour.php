<?php require 'partials/header.php'; ?>

<h3>Véhicules par jour</h3>

<table class="table table-bordered table-striped">
  <thead class="table-dark">
    <tr>
      <th>Date</th>
      <th>Véhicule</th>
      <th>Chauffeur</th>
      <th>Kilometres effectuées</th>
      <th>Recette totale</th>
      <th>Carburant total</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= $row['date'] ?></td>
        <td><?= $row['marque'] ?></td>
        <td><?= $row['chauffeur'] ?></td>
        <td><?= $row['km'] ?> km</td>
        <td><?= $row['recette'] ?> Ar</td>
        <td><?= $row['carburant'] ?> Ar</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

