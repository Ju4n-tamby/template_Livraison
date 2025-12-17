<?php
namespace app\models;

use PDO;

class VehiculeDuJour
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function listeVehicules_chauffeur()
  {
    $sql = "
            SELECT
                vd.id,
                vd.date,
                v.marque,
                c.nom AS chauffeur
            FROM VoitureDujour vd
            JOIN Vehicule v ON vd.idVehicule = v.id
            JOIN Chauffeur c ON vd.idChauffeur = c.id
            ORDER BY vd.date DESC
        ";

    return $this->db->query($sql)->fetchAll();
  }

  public function getTotalDonnees($idVoitureDuJour)
  {
    $sql = "
            SELECT
              COALESCE(SUM(t.distance * 2),0) AS km,
              COALESCE(SUM(m.montantRecette * 2),0) AS recette,
              COALESCE(SUM(m.montantCarburant * 2),0) AS carburant
          FROM Mouvement m
          JOIN Trajet t ON m.idTrajet = t.id
          WHERE m.idVoitureDuJour = ?
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idVoitureDuJour]);

    return $stmt->fetch();
  }

  public function lstVehiculeDispo($date)
  {
    $sql = "
            SELECT
                vd.id,
                v.marque,
                c.nom AS chauffeur
            FROM VoitureDujour vd
            JOIN Vehicule v ON vd.idVehicule = v.id
            JOIN Chauffeur c ON vd.idChauffeur = c.id
            WHERE vd.date = ?
        ";

    $stmt = $this->db->prepare($sql);
    $stmt->execute([$date]);

    return $stmt->fetchAll();
  }
}
