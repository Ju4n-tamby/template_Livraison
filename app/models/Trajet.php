<?php
namespace app\models;

use PDO;

class Trajet
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getTrajetRentable($jour)
  {
    $sql = "
            SELECT
                t.id,
                t.depart,
                t.arrivee,
                SUM(m.montantRecette) - SUM(m.montantCarburant) AS benefice
            FROM Mouvement m
            JOIN VoitureDujour vd ON m.idVoitureDuJour = vd.id
            JOIN Trajet t ON m.idTrajet = t.id
            WHERE vd.date = ?
            GROUP BY t.id
            ORDER BY benefice DESC
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$jour]);

    return $stmt->fetchAll();
  }
}
