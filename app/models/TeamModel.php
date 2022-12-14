<?php
class TeamModel
{
  private $db;
  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;' . 'dbname=liga;charset=utf8', 'root', '');
  }
  public function getAllTeamsOrder($campo,$orden)
  {
    $query = $this->db->prepare('SELECT * FROM equipos ORDER BY ' . $campo .' ' .$orden);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  public function showAll_limit($id, $limite)
  {
    $query = $this->db->prepare('SELECT * FROM equipos ORDER BY id_equipo LIMIT ' . $id . ',' . $limite);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  public function getAllTeams()
  {
    $query = $this->db->prepare('SELECT * FROM equipos ORDER BY id_equipo ASC');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  public function getAllTeamsTable($campo)
  {
    $query = $this->db->prepare('SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "equipos" AND COLUMN_NAME="'.$campo.'"');
    $query->execute();
    return $query->fetch(PDO::FETCH_COLUMN);
  }
  public function getTeamById($id)
  {
    $query = $this->db->prepare('SELECT * FROM equipos WHERE id_equipo=?');
    $query->execute(array($id));
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  public function newTeam($id_fk_liga, $nombre, $logo, $historia, $jugadores)
  {
    $query = $this->db->prepare('INSERT INTO equipos(id_fk_liga, nombre, logo, historia, jugadores) VALUES(?,?,?,?,?)');
    $query->execute([$id_fk_liga, $nombre, $logo, $historia, $jugadores]);
    return $this->db->lastInsertId();
  }
  public function deleteEquipos($idEquipo)
  {
    $query = $this->db->prepare('DELETE FROM equipos WHERE id_equipo=?');
    $query->execute([$idEquipo]);
  }
  public function updateEquipos($id, $id_fk_liga, $nombre, $logo, $historia, $jugadores)
  {
    $query = $this->db->prepare('UPDATE equipos SET id_fk_liga=?, nombre=?, logo=?, historia=?, jugadores=? WHERE id_equipo=?');
    $query->execute([$id, $id_fk_liga, $nombre, $logo, $historia, $jugadores]);
  }
}
