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
    public function addTeam($params = null){
        $data = $this->getData();
        $league = $this->leagueModel->getLigasID($data->id_fk_liga);
        if((count($league))>0){
        $id = $this->teamModel->newTeam($data->id_fk_liga, $data->nombre, $data->logo, $data->historia, $data->jugadores);
        
/*         Warning</b>:  Attempt to read property "id_fk_liga" on array in <b>C:\xampp\htdocs\WEB2-TP2-BIDI\app\controllers\TeamController.php</b> on line <b>50</b><br />
<br />
<b>Fatal error</b>:  Uncaught TypeError: count(): Argument #1 ($value) must be of type Countable|array, bool given in C:\xampp\htdocs\WEB2-TP2-BIDI\app\controllers\TeamController.php:51
Stack trace:
#0 C:\xampp\htdocs\WEB2-TP2-BIDI\router.php(41): TeamController-&gt;addTeam(Array)
#1 C:\xampp\htdocs\WEB2-TP2-BIDI\router.php(59): Route-&gt;run()
#2 C:\xampp\htdocs\WEB2-TP2-BIDI\routerApi.php(26): Router-&gt;route('equipos', 'POST')
#3 {main}
  thrown in <b>C:\xampp\htdocs\WEB2-TP2-BIDI\app\controllers\TeamController.php</b> on line <b>51</b><br /> */
        if(!empty($id)){
            $this->teamView->response($id, 200);
        }else{
            $this->teamView->response("no se pudo completar la accion con exito, llene todos los campos", 404);
        }
    }else{
            $this->teamView->response("error, no existe un una liga para ese equipo", 400);
        }
    }

}
