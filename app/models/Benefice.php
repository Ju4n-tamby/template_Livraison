<?php
namespace app\models;

use PDO;

class Benefice
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function calculChiffreAffaire($idColis)
  {
    $sql = "SELECT prix_kg FROM lvr_Param_Livraison";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $param = $stmt->fetch();
    $prixPoids = $param['prix_kg'];

    $sql = "SELECT poids FROM lvr_Colis WHERE id_colis = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idColis]);
    $colis = $stmt->fetch();
    $poidsColis = $colis['poids'];
    return $prixPoids * $poidsColis;
  }

  public function getAllRevient($livraisons)
  {
    $sql = "SELECT lv.montant_recette AS revient, lvr.salaire AS salaire, lz.bonus AS bonus
            FROM lvr_Livraisons lv
            JOIN lvr_Livreurs lvr ON lv.id_livreur = lvr.id_livreur
            JOIN lvr_Zone lz ON lv.id_zone = lz.id_zone
            WHERE id_livraison = ?";
    $revient = 0;
    foreach ($livraisons as $livraison) {
      $stmt = $this->db->prepare($sql);
      $stmt->execute([$livraison['id_livraison']]);
      $result = $stmt->fetch();
      $revient += $result['revient'] + $result['salaire'] + ($result['bonus'] * $result['salaire']) / 100;
    }
    return $revient;
  }

  public function getBeneficeVehicule($idVehicule)
  {
    // Récupérer toutes les livraisons pour ce véhicule
    $sql = "SELECT lv.id_livraison, lv.id_colis, lv.montant_recette, lvr.salaire, lz.bonus
            FROM lvr_Livraisons lv
            JOIN lvr_Livreurs lvr ON lv.id_livreur = lvr.id_livreur
            JOIN lvr_Zone lz ON lv.id_zone = lz.id_zone
            WHERE lv.id_vehicule = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idVehicule]);
    $livraisons = $stmt->fetchAll();

    $chiffreAffaire = 0;
    $revient = 0;

    foreach ($livraisons as $livraison) {
      // Calculer le chiffre d'affaire pour chaque colis
      $chiffreAffaire += $this->calculChiffreAffaire($livraison['id_colis']);

      // Calculer le revient (salaire + bonus)
      $revient += $livraison['montant_recette'] + $livraison['salaire'] + ($livraison['bonus'] * $livraison['salaire']) / 100;
    }

    $benefice = $chiffreAffaire - $revient;

    return [
      'chiffre_affaire' => $chiffreAffaire,
      'revient' => $revient,
      'benefice' => $benefice
    ];
  }

  public function getAllBeneficesVehicules()
  {
    // Récupérer tous les véhicules
    $sql = "SELECT id_vehicule, marque FROM lvr_Vehicules";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $vehicules = $stmt->fetchAll();

    $resultats = [];
    foreach ($vehicules as $vehicule) {
      $benefices = $this->getBeneficeVehicule($vehicule['id_vehicule']);
      $resultats[] = array_merge($vehicule, $benefices);
    }

    return $resultats;
  }

  public function getDetailsBeneficeVehicule($idVehicule)
  {
    // Récupérer toutes les livraisons pour ce véhicule avec détails
    $sql = "SELECT lv.id_livraison, lv.id_colis, lv.date_livraison, lv.montant_recette, lvr.salaire, lz.bonus, v.marque
            FROM lvr_Livraisons lv
            JOIN lvr_Livreurs lvr ON lv.id_livreur = lvr.id_livreur
            JOIN lvr_Zone lz ON lv.id_zone = lz.id_zone
            JOIN lvr_Vehicules v ON lv.id_vehicule = v.id_vehicule
            WHERE lv.id_vehicule = ?
            ORDER BY lv.date_livraison DESC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idVehicule]);
    $livraisons = $stmt->fetchAll();

    $details = [];
    foreach ($livraisons as $livraison) {
      $chiffre = $this->calculChiffreAffaire($livraison['id_colis']);
      $revient = $livraison['montant_recette'] + $livraison['salaire'] + ($livraison['bonus'] * $livraison['salaire']) / 100;
      $benefice = $chiffre - $revient;

      $details[] = [
        'id_livraison' => $livraison['id_livraison'],
        'date_livraison' => $livraison['date_livraison'],
        'marque' => $livraison['marque'],
        'chiffre_affaire' => $chiffre,
        'revient' => $revient,
        'benefice' => $benefice
      ];
    }

    return $details;
  }
}
