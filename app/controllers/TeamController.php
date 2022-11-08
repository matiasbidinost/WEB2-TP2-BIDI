<?php
require_once "./app/models/TeamModel.php";
require_once "./app/views/TeamView.php";
require_once "./api/JSONView.php";

class TeamController
{
    private $teamModel;
    private $teamView;

    private $data;

    public function __construct()
    {
        $this->teamModel = new TeamModel();
        $this->teamView = new TeamView();
        $this->teamView = new JSONView();
        $this->data = file_get_contents("php://input");
    }

        private function getData() {
        return json_decode($this->data);
    }
    public function showTeams($params=null){
        $equipos=$this->teamModel->getAllTeams();
        return $this->teamView->response($equipos, 200);
    }

}