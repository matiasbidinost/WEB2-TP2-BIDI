<?php
class ApiModel
{
  private $db;
  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;' . 'dbname=liga;charset=utf8', 'root', '');
  }
  public function getAllLigas()
  { 
    $query = $this->db->prepare('SELECT * FROM ligas ORDER BY liga ASC');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}