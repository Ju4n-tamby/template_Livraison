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
}
