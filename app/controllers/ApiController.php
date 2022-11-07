<?php
require_once "./app/models/ApiModel.php";
require_once "./app/views/ApiView.php";

class ApiController
{
    private $apiModel;
    private $apiView;

    public function __construct()
    {
        $this->apiModel = new ApiModel();
        $this->apiView = new ApiView();
    }

    //  public function get($params = null) {
    //       $tareas = $this->apiModel->getTareas();
    //       return
    //     $this->apiView->response($tareas, 200);
    //  }
    public function showLeagues(){
        $ligas = $this->apiModel->getAllLigas();
        if (!empty($ligas)) {
          $this->apiView->showLigas($ligas, 200);
        }else{
            $this->ApiView->error(404);
        }
    }
}
