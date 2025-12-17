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

  public function getBeneficeParJour($jour)
  {
    $sql = "
            SELECT
                COALESCE(SUM(m.montantRecette),0) AS recette,
                COALESCE(SUM(m.montantCarburant),0) AS carburant
            FROM Mouvement m
            JOIN VoitureDujour vd ON m.idVoitureDuJour = vd.id
            WHERE vd.date = ?
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$jour]);
    $res = $stmt->fetch();

    return $res['recette'] - $res['carburant'];
  }
}
