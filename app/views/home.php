<?php
$today = date('Y-m-d');
$currentMonth = date('m');
$currentYear = date('Y');
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <title>Accueil Taxibe</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 40px;
      background: #f4f4f4;
    }

    h1 {
      color: #0d6efd;
    }

    ul {
      list-style: none;
      padding: 0;
    }

    li {
      margin: 10px 0;
    }

    a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    a:hover {
      color: #0d6efd;
    }
  </style>
</head>

<body>
  <h1>Bienvenue sur l'application Taxibe</h1>
  <p>Accédez aux différentes pages :</p>
  <ul>
    <li><a href="/vehiculeJour">Véhicules du jour</a></li>
    <li><a href="/beneficeVehicule">Bénéfice par véhicule</a></li>
    <li><a href="/beneficeJour?jour=<?= $today ?>">Bénéfice par jour (<?= $today ?>)</a></li>
    <li><a href="/trajetRentable?jour=<?= $today ?>">Trajets rentables (<?= $today ?>)</a></li>
    <li><a href="/vehiculeDispo?date=<?= $today ?>">Véhicules disponibles (<?= $today ?>)</a>
    </li>
    <li><a href="/tauxPanne?mois=<?= $currentMonth ?>&annee=<?= $currentYear ?>">Taux de panne
        (<?= $currentMonth ?>/<?= $currentYear ?>)</a></li>
    <li><a href="/salaireJournalier?date=<?= $today ?>">Salaire journalier chauffeurs
        (<?= $today ?>)</a></li>
  </ul>
</body>

</html>
