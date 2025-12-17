<?php require 'partials/header.php'; ?>

<h3>Bénéfice par véhicule</h3>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Véhicule</th>
      <th>Bénéfice (Ar)</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $v): ?>
      <tr>
        <td><?= $v['marque'] ?></td>
        <td class="<?= $v['benefice'] >= 0 ? 'text-success' : 'text-danger' ?>">
          <?= number_format($v['benefice'], 0, ',', ' ') ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

