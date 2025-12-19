<?php
namespace app\models;

use PDO;

class Livraison
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function insererLivraison($idColis, $idVehicule, $idLivreur, $dateLivraison, $idStatut, $montantRecette, $idZone)
  {
    $sql = "INSERT INTO lvr_Livraisons (id_colis, id_vehicule, id_livreur, date_livraison, id_statut, montant_recette, id_zone) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$idColis, $idVehicule, $idLivreur, $dateLivraison, $idStatut, $montantRecette, $idZone]) ? true : false;
  }

  public function deleteLivraison($id)
  {
    $sql = "DELETE FROM lvr_Livraisons WHERE id_livraison = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id]);
  }

  public function changeStatut($id, $id_statut)
  {
    $sql = "UPDATE lvr_Livraisons SET id_statut = ? WHERE id_livraison = ?";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$id_statut, $id]) ? true : false;
  }

  public function getParametre()
  {
    $sql = "SELECT * FROM lvr_Param_Livraison LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
  }

  public function getAlllivraison($jour, $mois, $annee)
  {
    if ($jour == null && $mois == null) {
      $dateDebut = sprintf('%04d-01-01 00:00:00', $annee);
      $dateFin = sprintf('%04d-12-31 23:59:59', $annee);
    } elseif ($jour === null) {
      $dateDebut = sprintf('%04d-%02d-01 00:00:00', $annee, $mois);
      $dateFin = sprintf('%04d-%02d-' . date('t', mktime(0, 0, 0, $mois, 1, $annee)) . ' 23:59:59', $annee, $mois);
    } else {
      $dateDebut = sprintf('%04d-%02d-%02d 00:00:00', $annee, $mois, $jour);
      $dateFin = sprintf('%04d-%02d-%02d 23:59:59', $annee, $mois, $jour);
    }

    $sql = "SELECT * FROM lvr_Livraisons WHERE date_livraison BETWEEN ? AND ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$dateDebut, $dateFin]);
    return $stmt->fetchAll();
  }

  public function getAll()
  {

    $sql = "SELECT l.id_livraison, lv.nom, v.marque, c.libelle, z.zone, l.date_livraison, s.libelle AS statut, c.poids
            FROM lvr_Livraisons l
            JOIN lvr_Livreurs lv ON l.id_livreur = lv.id_livreur
            JOIN lvr_Vehicules v ON l.id_vehicule = v.id_vehicule
            JOIN lvr_Statut s ON l.id_statut = s.id_statut
            JOIN lvr_Zone z ON l.id_zone = z.id_zone
            JOIN lvr_Colis c ON l.id_colis = c.id_colis
            ORDER BY id_livraison";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
