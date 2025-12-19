<?php
namespace app\controllers;

use app\models\Livreur;
use app\models\Vehicule;
use app\models\Statut;
use app\models\Zone;
use app\models\Colis;
use app\models\Livraison;
use app\models\Benefice;
use PDO;

class LivraisonController
{
  private $livreurModel;
  private $vehiculesModel;
  private $statutModel;
  private $zoneModel;
  private $colisModel;
  private $livraisonModel;
  private $beneficeModel;

  public function __construct(PDO $db)
  {
    $this->livreurModel = new Livreur($db);
    $this->vehiculesModel = new Vehicule($db);
    $this->statutModel = new Statut($db);
    $this->zoneModel = new Zone($db);
    $this->colisModel = new Colis($db);
    $this->livraisonModel = new Livraison($db);
    $this->beneficeModel = new Benefice($db);
  }

  public function getDonneesFormulaires()
  {
    return [
      'chauffeurs' => $this->livreurModel->getAllChauffeur(),
      'status' => $this->statutModel->getAllStatut(),
      'vehicules' => $this->vehiculesModel->getAllVehicule(),
      'zones' => $this->zoneModel->getAllZone(),
    ];
  }

  public function insererDonnees($inputs)
  {
    $colisId = $this->colisModel->insererColis($inputs['colis_libelle'], $inputs['colis_poids']);

    if (!$colisId) {
      return false;
    }

    $date_livraison = $inputs['date'] . ' ' . $inputs['heure'];
    $inputs['date'] = $date_livraison;

    return $this->livraisonModel->insererLivraison($colisId, $inputs['idVehicule'], $inputs['idlivreur'], $inputs['date'], $inputs['idStatut'], $inputs['montant'], $inputs['idZone']);
  }

  public function getAllLivraison()
  {
    return $this->livraisonModel->getAll();
  }

  public function calculerBenefice($jour, $mois, $annee)
  {
    $livraisons = $this->livraisonModel->getAlllivraison($jour, $mois, $annee);

    $chiffreAffaire = 0;
    foreach ($livraisons as $livraison) {
      $chiffreAffaire += $this->beneficeModel->calculChiffreAffaire($livraison['id_colis']);
    }

    $revient = $this->beneficeModel->getAllRevient($livraisons);

    return $chiffreAffaire - $revient;
  }

  public function changeStatut($id, $statut)
  {
    return $this->livraisonModel->changeStatut($id, $statut);
  }
}
