<?php require 'partials/header.php'; ?>

<h1>Salaire journalier des chauffeurs - <?= $date ?></h1>

<table border="1" cellpadding="5">
  <thead>
    <tr>
      <th>Chauffeur</th>
      <th>Véhicule</th>
      <th>Montant du versement</th>
      <th>% appliqué</th>
      <th>Salaire</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row): ?>
      <tr>
        <td><?= htmlspecialchars($row['chauffeur']) ?></td>
        <td><?= htmlspecialchars($row['vehicule']) ?></td>
        <td><?= number_format($row['montant_verse'], 2) ?></td>
        <td><?= $row['pourcentage'] ?>%</td>
        <td><?= number_format($row['salaire'], 2) ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

