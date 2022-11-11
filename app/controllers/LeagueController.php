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

    private function getData()
    {
        return json_decode($this->data);
    }


    // Muestro la LIGA completa
    public function showLeagues($params = null)
    {
        $ligas = $this->leagueModel->getAllLigas();
        return $this->leagueView->response($ligas, 200);
    }
    // Muestro la Liga por ID
    public function showIDLeague($params = null)
    {
        $id = $params[':ID'];

        $ligas = $this->leagueModel->getLigasID($id);
        if ($ligas) {
            $this->leagueView->response($ligas, 200);
        } else {
            $this->leagueView->response("La liga con el id=$id no existe", 404);
        }
    }
    // Elimino una Liga por ID
    public function deleteLeague($params = null)
    {
        $id = $params[':ID'];
        $liga = $this->leagueModel->getLigasID($id);
        if ($liga) {
            $this->leagueModel->deleteLigas($id);
            $ligaDelete = $this->leagueModel->getLigasID($id);
            if ($ligaDelete) {
                $this->leagueView->response("La liga con el id={$id} no se pudo eliminar, por que tiene equipos", 500);
            } else {
                $this->leagueView->response("La liga fue borrada con exito.", 200);
            }
        } else {
            $this->leagueView->response("La liga con el id={$id} no existe", 404);
        }
    }

    // Creo una Liga Por ID
    public function addLeague()
    {
        $data = $this->getData();
        if ((isset($data)) && (!empty($data))) {
            $logo = $data->logo;
            $liga = $data->liga;
            $record = $data->record;
            $historia = $data->historia;

            if ((!empty($logo)) && (!empty($liga)) && (!empty($record)) && (!empty($historia))) {
                $id = $this->leagueModel->newLeague($logo, $liga, $record, $historia);

                $ligas = $this->leagueModel->getLigasID($id);
                if ($ligas) {
                    $this->leagueView->response($ligas, 200);
                } else {
                    $this->leagueView->response("La liga no pudo ser fue creada", 500);
                }
            } else {
                $this->leagueView->response("la liga no puede ser creada por que hay campos vacios", 400);
            }
        } else {
            $this->leagueView->response("la liga no puede ser creada por que hay campos vacios", 400);
        }
    }
    // Modifico una liga
    public function updateLeague($params = null)
    {
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
        } else {
            $this->leagueView->response("La liga con el id={$id} no existe", 404);
        }
    }
}
