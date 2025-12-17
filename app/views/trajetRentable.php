<?php require 'partials/header.php'; ?>

<h3>Trajets les plus rentables</h3>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Départ</th>
      <th>Arrivée</th>
      <th>Bénéfice (Ar)</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $t): ?>
      <tr>
        <td><?= $t['depart'] ?></td>
        <td><?= $t['arrivee'] ?></td>
        <td class="text-success">
          <?= number_format($t['benefice'], 0, ',', ' ') ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

