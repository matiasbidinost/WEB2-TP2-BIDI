<?php
class LeagueModel
{
  private $db;
  public function __construct()
  {
    $this->db = new PDO('mysql:host=localhost;' . 'dbname=liga;charset=utf8', 'root', '');
  }
  public function getAllLigas()
  { 
    // Obtengo todas las ligas
    $query = $this->db->prepare('SELECT * FROM ligas ORDER BY liga ASC');
    $query->execute();
    return $query->fetchAll(PDO::FETCH_OBJ);
  }
  // Obtengo dato de LIga por ID
  public function getLigasID($idLeague){
    $query = $this->db->prepare("SELECT * FROM ligas WHERE idLiga = ?");
    $query->execute(array($idLeague));
    return $query->fetch(PDO::FETCH_OBJ);
  }
    //    * Elimina una tarea de la BBDD según el id pasado.
    function deleteLigas($idLeague) {
        $query = $this->db->prepare('DELETE FROM ligas WHERE idLiga = ?');
        $query->execute([$idLeague]); 
    }
// Añado una Liga
    public function newLeague($logo, $liga, $record, $historia) {
        $query = $this->db->prepare('INSERT INTO ligas(logo, liga, record, historia) VALUES(?,?,?,?)');
        $query->execute([$logo, $liga, $record, $historia]); 
        return $this->db->lastInsertId();
  }
  // Modifico una liga
    public function updateLigas($id, $logo, $liga, $record, $historia){
      $query = $this->db->prepare('UPDATE ligas SET logo = ?, liga = ?, record = ?, historia = ? WHERE idLiga = ?');
      $query->execute([$logo, $liga, $record, $historia, $id]);
    }
}