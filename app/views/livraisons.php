<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Livraisons</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>

<body>
  <div class="container">
    <h1>📦 Liste des Livraisons</h1>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Client</th>
          <th>Véhicule</th>
          <th>Colis</th>
          <th>Adresse</th>
          <th>Date</th>
          <th>Statut</th>
          <th>Action</th>
        </tr>
      </thead>

      <tbody>
        <?php foreach ($livraisons as $l) { ?>
          <tr>
            <td data-label="ID"><?= $l['id_livraison'] ?></td>
            <td data-label="Client"><?= $l['nom'] ?></td>
            <td data-label="Véhicule"><?= $l['marque'] ?></td>
            <td data-label="Colis"><?= $l['libelle'] . " " . $l['poids'] . " kg" ?></td>
            <td data-label="Adresse"><?= $l['zone'] ?></td>
            <td data-label="Date"><?= $l['date_livraison'] ?></td>
            <td data-label="Statut">
              <span class="status <?= strtolower(str_replace(' ', '-', $l['statut'])) ?>">
                <?= $l['statut'] ?>
              </span>
            </td>
            <td>
              <?php if ($l['statut'] == "En attente") { ?>
                <a href="<?= BASE_URL ?>/update?id_livraison=<?= $l['id_livraison'] ?>&id_statut=2"
                  class="action-btn livrer">Livrer</a>
                <a href="<?= BASE_URL ?>/update?id_livraison=<?= $l['id_livraison'] ?>&id_statut=3"
                  class="action-btn annuler">Annuler</a>
              <?php } ?>
            </td>

          </tr>
        <?php } ?>
      </tbody>

    </table>

    <a href="<?= BASE_URL ?>/" class="btn-home">Retour à l'accueil</a>
  </div>
</body>

</html>
