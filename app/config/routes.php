<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Flight;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\config\Database;
use app\controllers\LivraisonController;

/**
 * @var Router $router
 * @var Engine $app
 */

$router->group('', function ($router) {

  $router->get('/', function () {
    Flight::render('home', );
  });

  $router->get('/test', function () {
    echo "ROUTE OK";
  });

  $router->get('/formulaireLivraison', function () {
    $controller = new LivraisonController(Flight::db());
    $data = $controller->getDonneesFormulaires();
    Flight::render('formulaire', ['chauffeurs' => $data['chauffeurs'], 'status' => $data['status'], 'vehicules' => $data['vehicules'], 'zones' => $data['zones']]);
  });

  $router->get('/listeLivraisons', function () {
    $controller = new LivraisonController(Flight::db());
    $livraisons = $controller->getAllLivraison();
    Flight::render('livraisons', ['livraisons' => $livraisons]);
  });

  $router->post('/submit_livraison', function () {

    $inputs = [
      'date' => Flight::request()->data->date,
      'heure' => Flight::request()->data->heure,
      'idlivreur' => Flight::request()->data->idlivreur,
      'idVehicule' => Flight::request()->data->idVehicule,
      'idStatut' => Flight::request()->data->idStatut,
      'idZone' => Flight::request()->data->idZone,
      'montant' => Flight::request()->data->montant,
      'colis_libelle' => Flight::request()->data->colis_libelle,
      'colis_poids' => Flight::request()->data->colis_poids,
    ];

    $controller = new LivraisonController(Flight::db());
    $success = $controller->insererDonnees($inputs);

    if ($success) {
      echo "Données insérées avec succès.";
      header("Location:" . BASE_URL . "/listeLivraisons");
      exit();
    } else {
      echo "Erreur lors de l'insertion des données.";
    }
  });

  $router->get('/calculerBenefice', function () {
    $jour = $_GET['jour'] ?? null;
    $mois = $_GET['mois'] ?? null;
    $annee = $_GET['annee'] ?? null;

    if ($jour == 0) {
      $jour = null;
    }
    if ($mois == 0) {
      $mois = null;
    }

    $controller = new LivraisonController(Flight::db());
    $benefice = $controller->calculerBenefice($jour, $mois, $annee);

    Flight::render('benefice', ['benefice' => $benefice, 'jour' => $jour, 'mois' => $mois, 'annee' => $annee]);
  });

  $router->get('/update', function () {
    $id_livraison = $_GET['id_livraison'] ?? null;
    $id_statut = $_GET['id_statut'] ?? null;

    if ($id_livraison === null || $id_statut === null) {
      echo "Données invalides.";
    }

    $controller = new LivraisonController(Flight::db());
    $success = $controller->changeStatut($id_livraison, $id_statut);
    if ($success) {
      echo "Données insérées avec succès.";
      header("Location:" . BASE_URL . "/listeLivraisons");
      exit();
    } else {
      echo "Erreur lors de l'insertion des données.";
    }
  });

  $router->get('/benefices_vehicules', function () {
    $controller = new LivraisonController(Flight::db());
    $benefices = $controller->getBeneficesVehicules();
    Flight::render('benefice_vehicule', ['benefices' => $benefices]);
  });
}, [SecurityHeadersMiddleware::class]);
