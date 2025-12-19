<?php
namespace app\models;

use PDO;

class Livreur
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getAllChauffeur()
  {
    $sql = "SELECT * FROM lvr_Livreurs ORDER BY id_livreur ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
