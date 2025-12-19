<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bénéfice</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>
  <div class="container">
    <h1>💰 Bénéfice Journalier</h1>

    <div class="benefice-row">
      <span class="label">Date</span>
      <span class="date">
        <?= sprintf('%02d/%02d/%04d', $jour, $mois, $annee) ?>
      </span>
    </div>
  </div>

  <div class="benefice-card">
    <div class="benefice-row">
      <span class="label">Montant total</span>
      <span class="value">
        <?= number_format($benefice, 2, ',', ' ') ?> Ar
      </span>
    </div>

    <a href="<?= BASE_URL ?>/listeLivraisons" class="btn-home">
      ← Retour à la liste
    </a><a href="<?= BASE_URL ?>/" class="btn-home">
      ← Retour à l'accueil
    </a>
  </div>
</body>

</html>
