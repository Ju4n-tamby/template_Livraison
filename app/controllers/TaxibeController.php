<?php
namespace app\controllers;

use app\models\VehiculeDuJour;
use app\models\Vehicule;
use app\models\Benefice;
use app\models\Trajet;
use app\models\Salaire;
use PDO;

class TaxibeController
{
  private $vehiculeDuJourModel;
  private $vehiculeModel;
  private $beneficeModel;
  private $trajetModel;
  private $salaireModel;

  public function __construct(PDO $db)
  {
    $this->vehiculeDuJourModel = new VehiculeDuJour($db);
    $this->vehiculeModel = new Vehicule($db);
    $this->beneficeModel = new Benefice($db);
    $this->trajetModel = new Trajet($db);
    $this->salaireModel = new Salaire($db); // ajout
  }

  public function salaireJournalier($date)
  {
    return $this->salaireModel->getSalaireJournalier($date);
  }

  public function vehiculesParJour()
  {
    $voituresJour = $this->vehiculeDuJourModel->listeVehicules_chauffeur();

    foreach ($voituresJour as $key => $v) {
      $donnees = $this->vehiculeDuJourModel->getTotalDonnees($v['id']);
      $voituresJour[$key]['km'] = $donnees['km'];
      $voituresJour[$key]['recette'] = $donnees['recette'];
      $voituresJour[$key]['carburant'] = $donnees['carburant'];
    }

    return $voituresJour;
  }

  public function beneficeParVehicule()
  {
    $vehicules = $this->vehiculeModel->getAllVehicle();

    foreach ($vehicules as &$v) {
      $v['benefice'] = $this->vehiculeModel->getTotalBenefice($v['id']);
    }

    return $vehicules;
  }

  public function beneficeParJour($jour)
  {
    return [
      'jour' => $jour,
      'benefice' => $this->beneficeModel->getBeneficeParJour($jour)
    ];
  }

  public function trajetsRentables($jour)
  {
    return $this->trajetModel->getTrajetRentable($jour);
  }

  public function vehiculesDisponibles($date)
  {
    return $this->vehiculeDuJourModel->lstVehiculeDispo($date);
  }

  public function tauxPanne($mois, $annee)
  {
    return $this->vehiculeModel->tauxPanne($mois, $annee);
  }
}
