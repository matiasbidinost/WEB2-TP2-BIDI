<?php
require_once "./app/models/TeamModel.php";
require_once "./app/models/LeagueModel.php"; 
require_once "./api/JSONView.php";

class TeamController
{
    private $teamModel;
    private $leagueModel; 
    private $teamView;

    private $data;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->leagueModel = new LeagueModel(); 
        $this->teamView = new JSONView();
        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }
    public function showAll($params = null)
    {
        if (isset($params) && !empty($params)) {
            $orden = strtoupper($params[':ORDEN']);
            $campo = strtolower($params[':CAMPO']);
            $teams = $this->teamModel->getAllteams();


            if ($orden == 'ASC') {
                if (isset($teams[1]->$campo)) { 

                    $equipos = $this->teamModel->getAllTeamsAsc($campo);
                    $this->teamView->response($equipos, 200);
                } else {
                    $this->teamView->response("error, no se puede ordenar por un parametro inexistente ", 404);
                }
            } else if ($orden == 'DESC') {
                if (isset($teams[1]->$campo)) {
                    $equipos = $this->teamModel->getAllTeamsDesc($campo);
                    $this->teamView->response($equipos, 200);
                } else {
                    $this->teamView->response("error, no se puede ordenar por un parametro inexistente ", 400);
                }
            } else {
                $this->teamView->response("usted no utilizo un orden valido, utilice la palabra correcta", 400);
            }
        } else {
            $this->teamView->response("error, debe decidir en que orden van los elementos (ASC=ascendente o DESC=descendente),y por cual campo", 400);
        }
    }
    public function showAllLimit($params = null)
    {
        if (isset($params) && !empty($params)) {
            if (is_numeric($params[':PAGNUM'])) {
                $id = intval($params[':PAGNUM']);
                $limite = 3;
                $cant = $this->teamModel->getAllTeams();
                $totalCant = count($cant);
                $start = ($id - 1) * $limite;
                $total_pages = ceil($totalCant / $limite);

                if ($id > 0 && $id <= $total_pages) {
                    $todo = $this->teamModel->showAll_limit($start, $limite);
                    $this->teamView->response($todo, 200);
                } else {
                    $this->teamView->response("pagina inexistente", 404);
                }
            } else {
                $this->teamView->response("ingrese un numero entero", 400);
            }
        } else {
            $this->teamView->response("no se ingreso un valor valido", 400);
        }
    }

    public function showTeams()
    {
        $equipos = $this->teamModel->getAllTeams();
        if (!empty($equipos)) {
            return $this->teamView->response($equipos, 200);
        }
    }
    public function showIdTeam($params = null)
    {
        if (isset($params) && !empty($params)) {
            $id = $params[':ID'];
            if (!empty($id)) {
                $equipo = $this->teamModel->getTeamById($id);
                if ((count($equipo)) > 0) {
                    $this->teamView->response($equipo, 200);
                } else {
                    $this->teamView->response("el id $id no existe", 404);
                }
            } else {
                $this->teamView->response("el id $id no existe", 404);
            }
        } else {
            $this->teamView->response("complete correctamente los parametros con un id", 400);
        }
    }
    // Agrego equipo
    public function addTeam()
    {
        $data = $this->getData();
        if (isset($data) && !empty($data)) {
            $id_fk_liga = $data->id_fk_liga;
            $nombre = $data->nombre;
            $logo = $data->logo;
            $historia = $data->historia;
            $jugadores = $data->jugadores;
            if ((isset($id_fk_liga) && !empty($id_fk_liga)) && (isset($nombre) && !empty($nombre))
                && (isset($logo) && !empty($logo)) && (isset($historia) && !empty($historia)) && (isset($jugadores) && !empty($jugadores))
            ) {
                $league = $this->leagueModel->getLigasID($id_fk_liga);
                if (!empty($league)) {
                    $equipos = $this->teamModel->newTeam($id_fk_liga, $nombre, $logo, $historia, $jugadores);
                    if (!empty($equipos)) {
                        $this->teamView->response("se registro un equipo con id= $nombre", 201);
                    } else {
                        $this->teamView->response("error, no existe un una liga para ese equipo", 400);
                    }
                } else {
                    $this->teamView->response("no se pudo completar la accion con exito, llene todos los campos", 404);
                }
            } else {
                $this->teamView->response("error, los parametros tienen que estar llenos para realizar esta tarea", 400);
            }
        } else {
            $this->teamView->response("error, los parametros tienen que estar llenos para realizar esta tarea", 400);
        }
    }
    public function deleteTeam($params = null)
    {
        if (isset($params) && !empty($params)) {
            $id = $params[':ID'];
            $equipo = $this->teamModel->getTeamById($id);

            if ($equipo) {
                $this->teamModel->deleteEquipos($id);
                $teamDelete = $this->teamModel->getTeamById($id);
                if ($equipo) {
                    $this->teamView->response("El equipo fue borrado con exito.", 200);
                }
            } else {
                $this->teamView->response("El equipo con el id={$id} no existe", 404);
            }
        } else {
            $this->teamView->response("error, los parametros tienen que estar llenos para realizar esta tarea", 400);
        }
    }
    public function modifyTeam($params = null)
    {
        if (isset($params) && !empty($params)) {
            $id = $params[':ID'];
            $equipos = $this->teamModel->getTeamById($id);
            if ($equipos) {
                $data = $this->getData();
                $id_fk_liga = $data->id_fk_liga;
                $nombre = $data->nombre;
                $logo = $data->logo;
                $historia = $data->historia;
                $jugadores = $data->jugadores;

                $this->teamModel->updateEquipos($id, $id_fk_liga, $nombre, $logo, $historia, $jugadores);
                $this->teamView->response("El equipo fue modificado con exito.", 201);
            } else {
                $this->teamView->response("El equipo con el id={$id} no existe", 404);
            }
        } else {
            $this->teamView->response("error, los parametros tienen que estar llenos para realizar esta tarea", 400);
        }
    }
}
