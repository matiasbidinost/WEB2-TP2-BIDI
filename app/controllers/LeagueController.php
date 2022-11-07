<?php
require_once "./app/models/LeagueModel.php";
require_once "./app/views/LeagueView.php";
require_once "./api/JSONView.php";

class LeagueController
{
    private $leagueModel;
    private $leagueView;

    public function __construct()
    {
        $this->leagueModel = new LeagueModel();
        $this->leagueView = new LeagueView();
        $this->leagueView = new JSONView();
    }
    public function showLeagues($params = null){
        // $ligas = $this->apiModel->getAllLigas();
        // if (!empty($ligas)) {
        //   $this->apiView->showLigas($ligas, 200);
        // }else{
        //     $this->ApiView->error(404);
        // }
      $ligas = $this->leagueModel->getAllLigas();
      return $this->leagueView->response($ligas, 200);
    }
}