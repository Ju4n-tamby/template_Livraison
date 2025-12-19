<?php
namespace app\models;

use PDO;

class Zone
{
  private $db;

  public function __construct(PDO $db)
  {
    $this->db = $db;
  }

  public function getAllZone()
  {
    $sql = "SELECT * FROM lvr_Zone ORDER BY id_zone ASC";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
  }
}
