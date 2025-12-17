<?php
namespace app\models;

use PDO;

class Vehicule
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getAllVehicle()
  {
    return $this->db->query("SELECT * FROM Vehicule")->fetchAll();
  }

  public function getTotalBenefice($idVehicule)
  {
    $sql = "
            SELECT
                COALESCE(SUM(m.montantRecette),0) AS recette,
                COALESCE(SUM(m.montantCarburant),0) AS carburant
            FROM Mouvement m
            JOIN VoitureDujour vd ON m.idVoitureDuJour = vd.id
            WHERE vd.idVehicule = ?
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idVehicule]);
    $res = $stmt->fetch();

    return $res['recette'] - $res['carburant'];
  }

  public function tauxPanne($mois, $annee)
  {
    $sql = "
            SELECT idVehicule, COUNT(*) AS nbJourTravaille
            FROM VoitureDujour
            WHERE MONTH(date)=? AND YEAR(date)=?
            GROUP BY idVehicule
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$mois, $annee]);

    $result = [];

    foreach ($stmt as $row) {
      $nbPanne = 25 - $row['nbJourTravaille'];
      if ($nbPanne < 0) {
        $nbPanne = 0;
      }
      $result[] = [
        'vehicule' => $row['idVehicule'],
        'nbJourTravaille' => $row['nbJourTravaille'],
        'nbPanne' => $nbPanne,
        'tauxPanne' => round($nbPanne / 25 * 100, 2)
      ];
    }

    return $result;
  }
}
