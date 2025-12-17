<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

use Flight;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\TaxibeController;
use app\config\Database;

/**
 * @var Router $router
 * @var Engine $app
 */

$router->group('', function ($router) {

  $router->get('/', function () {
    require __DIR__ . '/../views/home.php';
  });

  $router->get('/vehiculeJour', function () {
    $controller = new TaxibeController(Flight::db());
    $data = $controller->vehiculesParJour();
    require __DIR__ . '/../views/vehiculeJour.php';
  });

  $router->get('/beneficeVehicule', function () {
    $controller = new TaxibeController(Flight::db());
    $data = $controller->beneficeParVehicule();
    require __DIR__ . '/../views/beneficeVehicule.php';
  });

  $router->get('/beneficeJour', function () {
    $controller = new TaxibeController(Flight::db());
    $jour = $_GET['jour'] ?? date('Y-m-d');
    $data = $controller->beneficeParJour($jour);
    require __DIR__ . '/../views/beneficeJour.php';
  });

  $router->get('/trajetRentable', function () {
    $controller = new TaxibeController(Flight::db());
    $jour = $_GET['jour'] ?? date('Y-m-d');
    $data = $controller->trajetsRentables($jour);
    require __DIR__ . '/../views/trajetRentable.php';
  });

  $router->get('/vehiculeDispo', function () {
    $controller = new TaxibeController(Flight::db());
    $date = $_GET['date'] ?? date('Y-m-d');
    $data = $controller->vehiculesDisponibles($date);
    require __DIR__ . '/../views/vehiculeDispo.php';
  });

  $router->get('/tauxPanne', function () {
    $controller = new TaxibeController(Flight::db());
    $mois = $_GET['mois'] ?? date('m');
    $annee = $_GET['annee'] ?? date('Y');
    $data = $controller->tauxPanne($mois, $annee);
    require __DIR__ . '/../views/tauxPanne.php';
  });

  $router->get('/salaireJournalier', function () {
    $controller = new TaxibeController(Flight::db());
    $date = $_GET['date'] ?? date('Y-m-d');
    $data = $controller->salaireJournalier($date);
    require __DIR__ . '/../views/salaireJournalier.php';
  });

}, [SecurityHeadersMiddleware::class]);
