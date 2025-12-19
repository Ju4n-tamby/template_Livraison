<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulaire d'Insertion Livraison</title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/form.css">
</head>

<body>
  <h1>Formulaire d'Insertion Livraison</h1>
  <form action="<?= BASE_URL ?>/submit_livraison" method="POST">

    <div class="section">
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" required>

      <label for="heure">Heure:</label>
      <input type="time" id="heure" name="heure" required>

      <label for="chauffeur">Chauffeur:</label>
      <select id="chauffeur" name="idlivreur" required>
        <?php foreach ($chauffeurs as $c) { ?>
          <option value="<?= $c['id_livreur'] ?>"><?= $c['nom'] ?></option>
        <?php } ?>
      </select>

      <label for="vehicule">Véhicule:</label>
      <select id="vehicule" name="idVehicule" required>
        <?php foreach ($vehicules as $v) { ?>
          <option value="<?= $v['id_vehicule'] ?>"><?= $v['marque'] ?></option>
        <?php } ?>
      </select>

      <label for="status">Statut:</label>
      <select id="status" name="idStatut" required>
        <?php foreach ($status as $s) { ?>
          <option value="<?= $s['id_statut'] ?>"><?= $s['libelle'] ?></option>
        <?php } ?>
      </select>

      <label for="zone">Zone:</label>
      <select id="zone" name="idZone" required>
        <?php foreach ($zones as $z) { ?>
          <option value="<?= $z['id_zone'] ?>"><?= $z['zone'] ?></option>
        <?php } ?>
      </select>

      <label for="montant">Montant revient : </label>
      <input type="number" id="montant" name="montant" required>
    </div>

    <div class="section">
      <h2>Information sur le colis</h2>
      <label for="colis_libelle">Description :</label>
      <input type="text" id="colis_libelle" name="colis_libelle" required>

      <label for="colis_poids">Poids :</label>
      <input type="number" id="colis_poids" name="colis_poids" required>
    </div>

    <input type="submit" value="Soumettre">
  </form>
  <a href="<?= BASE_URL ?>/" class="btn-home">Retour à l'accueil</a>
</body>

</html>
