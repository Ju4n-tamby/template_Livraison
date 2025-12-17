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

  public function insererLivraison($idColis, $idVehicule, $idLivreur, $dateLivraison, $idStatut, $montantRecette, $idZone, $adresseDestination)
  {
    $sql = "INSERT INTO lvr_Livraisons (id_colis, id_vehicule, id_livreur, date_livraison, id_statut, montant_recette, id_zone, adresse_destination) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$idColis, $idVehicule, $idLivreur, $dateLivraison, $idStatut, $montantRecette, $idZone, $adresseDestination]);
  }

  public function getParametre()
  {
    $sql = "SELECT * FROM lvr_Param_Livraison LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetch();
  }
}
