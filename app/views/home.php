<?php
$annee = date('Y');
$mois = date('m');
$jour = date('d');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/accueil.css">
</head>

<body>
  <div class="container">
    <h1>📦 TEMPLATE LIVRAISON</h1>

    <div class="links">
      <a href="<?= BASE_URL ?>/formulaireLivraison">
        ➕ Ajouter une livraison
      </a>

      <a href="<?= BASE_URL ?>/listeLivraisons">
        📋 Liste des livraisons
      </a>
    </div>

    <form method="get" action="<?= BASE_URL ?>/calculerBenefice">
      <label for="jour">Jour :</label>
      <select id="jour" name="jour">
        <option value="0">NULL</option>
        <?php for ($d = 1; $d <= 31; $d++): ?>
          <option value="<?= $d ?>" <?= $d == $jour ? 'selected' : '' ?>><?= $d ?></option>
        <?php endfor; ?>
      </select>

      <label for="mois">Mois :</label>
      <select id="mois" name="mois">
        <option value="0">NULL</option>
        <?php
        $moisNoms = [
          1 => "Janvier",
          2 => "Février",
          3 => "Mars",
          4 => "Avril",
          5 => "Mai",
          6 => "Juin",
          7 => "Juillet",
          8 => "Août",
          9 => "Septembre",
          10 => "Octobre",
          11 => "Novembre",
          12 => "Décembre"
        ];
        for ($m = 1; $m <= 12; $m++): ?>
          <option value="<?= $m ?>" <?= $m == $mois ? 'selected' : '' ?>><?= $moisNoms[$m] ?></option>
        <?php endfor; ?>
      </select>

      <label for="annee">Année :</label>
      <select id="annee" name="annee">
        <?php for ($a = 2000; $a <= date('Y'); $a++): ?>
          <option value="<?= $a ?>" <?= $a == $annee ? 'selected' : '' ?>><?= $a ?></option>
        <?php endfor; ?>
      </select>

      <button type="submit">💰 Calculer le bénéfice</button>
    </form>

  </div>
</body>

</html>
