<?php require 'partials/header.php'; ?>

<h3>Bénéfice du <?= $data['jour'] ?></h3>

<div class="alert alert-info">
  <strong><?= number_format($data['benefice'], 0, ',', ' ') ?> Ar</strong>
</div>

<?php require 'partials/footer.php'; ?>

