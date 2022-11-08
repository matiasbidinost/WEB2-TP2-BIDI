<?php
require_once "./app/models/LeagueModel.php";
require_once "./app/views/LeagueView.php";
require_once "./api/JSONView.php";

class LeagueController
{
    private $leagueModel;
    private $leagueView;

    private $data;

    public function __construct()
    {
        $this->leagueModel = new LeagueModel();
        $this->leagueView = new LeagueView();
        $this->leagueView = new JSONView();
        $this->data = file_get_contents("php://input");
    }

        private function getData() {
        return json_decode($this->data);
    }


    // Muestro la LIGA completa
    public function showLeagues($params = null){
      $ligas = $this->leagueModel->getAllLigas();
      return $this->leagueView->response($ligas, 200);
    }
    // Muestro la Liga por ID
    public function showIDLeague($params = null) {
        $id = $params[':ID'];
        
      $ligas = $this->leagueModel->getLigasID($id);     
        if ($ligas){
            $this->leagueView->response($ligas, 200);
        }else{
            $this->leagueView->response("La liga con el id=$id no existe", 404);
        }
    } 
    // Elimino una Liga por ID
    public function deleteLeague($params = null) {
        $id = $params[':ID'];
      $ligas = $this->leagueModel->getLigasID($id); 
        if ($ligas) {
            $this->leagueModel->deleteLigas($id);
            $this->leagueView->response("La liga fue borrada con exito.", 200);
        } else{
            $this->leagueView->response("La liga con el id={$id} no existe", 404);
    
        }
    }

    // Creo una Liga Por ID
    public function addLeague($params = null) {
        $data = $this->getData();
        $id = $this->leagueModel->newLeague($data->logo, $data->liga, $data->record, $data->historia);
        
        $ligas = $this->leagueModel->getLigasID($id); 
        if ($ligas){
            $this->leagueView->response($ligas, 200);
        }else{
            $this->leagueView->response("La liga no pudo ser fue creada", 500);
        }
    }
    // Modifico una liga
        public function updateLeague($params = null) {
        $id = $params[':ID'];
        $ligas = $this->leagueModel->getLigasID($id); 
        if ($ligas) {
            $data = $this->getData();
            $logo = $data->logo;
            $liga = $data->liga;
            $record = $data->record;
            $historia = $data->historia;
            $this->leagueModel->updateLigas($id, $logo, $liga, $record, $historia);
            $this->leagueView->response("La liga fue modificada con exito.", 200);
        } else{
            $this->leagueView->response("La liga con el id={$id} no existe", 404);
        }
    }


}