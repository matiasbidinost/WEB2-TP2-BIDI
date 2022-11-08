<?php
class TeamModel
{
  private $db;
  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;' . 'dbname=liga;charset=utf8', 'root', '');
  }
  public function getAllTeams(){
    $query = $this->db->prepare('SELECT * FROM equipos ORDER BY id_equipo ASC');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  public function getTeamById($id){
    $query = $this->db->prepare('SELECT * FROM equipos WHERE id_equipo=?');
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
}