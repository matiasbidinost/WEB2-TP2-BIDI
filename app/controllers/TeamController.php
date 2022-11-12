<?php
require_once "./app/models/TeamModel.php";
require_once "./app/models/LeagueModel.php"; //lo necesito para poder saber que el equipo agregado corresponde a una liga
require_once "./app/views/TeamView.php";
require_once "./api/JSONView.php";

class TeamController
{
    private $teamModel;
    private $leagueModel; //lo necesito para poder saber que el equipo agregado corresponde a una liga
    private $teamView;

    private $data;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->leagueModel = new LeagueModel(); //lo necesito para poder saber que el equipo agregado corresponde a una liga
        $this->teamView = new TeamView();
        $this->teamView = new JSONView();
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    public function showTeams($params = null)
    {
        $equipos = $this->teamModel->getAllTeams();
        return $this->teamView->response($equipos, 200);
    }
    public function showIdTeam($params = null)
    {
        $id = $params[':ID'];
        if (!empty($id)) {
            $equipo = $this->teamModel->getTeamById($id);
            if((count($equipo))>0){
            $this->teamView->response($equipo, 200);
            }else{
                $this->teamView->response("el id $id no existe",404);
            }
        } else {
            $this->teamView->response("el id $id no existe", 404);
        }
    }
    // Agrego equipo
    public function addTeam($params = null){
        $data = $this->getData();
        $id_fk_liga = $data->id_fk_liga;
        $league = $this->leagueModel->getLigasID($id_fk_liga);
        if(!empty($league)){
        $equipos = $this->teamModel->newTeam($data->id_fk_liga, $data->nombre, $data->logo, $data->historia, $data->jugadores);
        if(!empty($equipos)){
            $this->teamView->response($equipos, 200);
        }else{
            $this->teamView->response("no se pudo completar la accion con exito, llene todos los campos", 404);
        }
    }else{
            $this->teamView->response("error, no existe un una liga para ese equipo", 400);
        }
    }
    public function deleteTeam($params = null){
      $id = $params[':ID'];
      $equipo = $this->teamModel->getTeamById($id);

      if($equipo){
        $this->teamModel->deleteEquipos($id);
        $teamDelete = $this->teamModel->getTeamById($id);
        if($equipo){
                $this->teamView->response("El equipo fue borrada con exito.", 200);
            }
        } else {
            $this->teamView->response("El equipo con el id={$id} no existe", 404);
        }
    }
    public function modifyTeam($params = null){
        $id = $params[':ID'];
        $equipos = $this->teamModel->getTeamById($id);
        if ($equipos) {
            $data = $this->getData();
            $id_fk_liga = $data->id_fk_liga;
            $nombre = $data->nombre;
            $logo = $data->logo;
            $historia = $data->historia;
            $jugadores = $data->jugadores;
            $this->teamModel->updateEquipos($id_fk_liga, $nombre, $logo, $historia, $jugadores);
            $this->teamView->response("El equipo fue modificada con exito.", 200);
        } else {
            $this->teamView->response("El equipo con el id={$id} no existe", 404);
        }
    }
  }
