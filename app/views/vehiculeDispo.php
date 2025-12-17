<?php require 'partials/header.php'; ?>

<h3>Véhicules disponibles</h3>

<table class="table table-bordered">
  <thead class="table-dark">
    <tr>
      <th>Véhicule</th>
      <th>Chauffeur</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $v): ?>
      <tr>
        <td><?= $v['marque'] ?></td>
        <td><?= $v['chauffeur'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php require 'partials/footer.php'; ?>

