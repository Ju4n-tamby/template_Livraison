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

  public function getAlllivraison($jour, $mois, $annee)
  {
    $dateDebut = sprintf('%04d-%02d-%02d 00:00:00', $annee, $mois, $jour);
    $dateFin   = sprintf('%04d-%02d-%02d 23:59:59', $annee, $mois, $jour);

    $sql = "SELECT * FROM lvr_Livraisons WHERE date_livraison BETWEEN ? AND ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$dateDebut, $dateFin]);
    return $stmt->fetchAll();
  }

  public function calculChiffreAffaire($idColis)
  {
    $sql = "SELECT SUM(montant_recette) AS chiffre_affaire FROM lvr_Livraisons WHERE id_colis = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idColis]);
    return $stmt->fetch();
  }

  public function getAllRevient($livraisons)
  {
    // Cette fonction dépendrait d'une table de coûts de revient par livraison/vehicule.
    // Pour l'instant, on renvoie 0 pour chaque livraison.
    $result = [];
    foreach ($livraisons as $livraison) {
      $result[] = [
        'id_livraison' => $livraison['id_livraison'],
        'montant_revient' => 0
      ];
    }
    return $result;
  }

  public function getBenefice($jour, $mois, $annee)
  {
    $livraisons = $this->getAlllivraison($jour, $mois, $annee);
    $revients = $this->getAllRevient($livraisons);

    $totalRecette = 0;
    foreach ($livraisons as $l) {
      $totalRecette += $l['montant_recette'];
    }

    $totalRevient = 0;
    foreach ($revients as $r) {
      $totalRevient += $r['montant_revient'];
    }

    return $totalRecette - $totalRevient;
  }
}
