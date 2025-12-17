<?php
namespace app\models;

use PDO;

class Salaire
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getSalaireJournalier($date)
  {
    $sqlParam = "SELECT * FROM Param_salaire LIMIT 1";
    $param = $this->db->query($sqlParam)->fetch(PDO::FETCH_ASSOC);
    $taux_min = $param['taux_salaire_min'] / 100;
    $taux_sup = $param['taux_salaire_sup'] / 100;

    $sql = "
            SELECT
                c.id AS chauffeur_id,
                c.nom AS chauffeur,
                v.id AS vehicule_id,
                v.marque AS vehicule,
                v.versement_min,
                SUM(m.montantRecette) AS montant_verse
            FROM VoitureDujour vd
            JOIN Chauffeur c ON vd.idChauffeur = c.id
            JOIN Vehicule v ON vd.idVehicule = v.id
            LEFT JOIN Mouvement m ON m.idVoitureDuJour = vd.id
            WHERE vd.date = ?
            GROUP BY vd.id
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$date]);
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $salaires = [];
    foreach ($resultats as $row) {
      $montant = $row['montant_verse'] ?? 0;
      $pourcentage = ($montant >= $row['versement_min']) ? $taux_sup : $taux_min;
      $salaire = $montant * $pourcentage;

      $salaires[] = [
        'chauffeur' => $row['chauffeur'],
        'vehicule' => $row['vehicule'],
        'montant_verse' => $montant,
        'pourcentage' => $pourcentage * 100,
        'salaire' => $salaire
      ];
    }

    return $salaires;
  }
}
