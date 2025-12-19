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

  public function getAllVehicule()
  {
    $sql = "SELECT * FROM lvr_Vehicules ORDER BY id_vehicule ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }

  public function getVehiculeById($idVehicule)
  {
    $sql = "SELECT * FROM lvr_Vehicules WHERE id_vehicule = ?";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$idVehicule]);
    return $stmt->fetch();
  }
}
