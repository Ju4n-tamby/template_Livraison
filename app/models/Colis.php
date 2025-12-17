<?php
namespace app\models;

use PDO;

class Colis
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function insererColis($libelle, $poids)
  {
    $sql = "INSERT INTO lvr_Colis (libelle, poids) VALUES (?, ?)";
    $stmt = $this->db->prepare($sql);
    return $stmt->execute([$libelle, $poids]);
  }
}
