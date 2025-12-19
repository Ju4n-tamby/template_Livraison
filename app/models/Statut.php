<?php
namespace app\models;

use PDO;

class Statut
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getAllStatut()
  {
    $sql = "SELECT * FROM lvr_Statut ORDER BY id_statut ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
