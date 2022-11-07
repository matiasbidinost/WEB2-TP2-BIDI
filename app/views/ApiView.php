<?php

class LeagueView
{
    private function _requestStatus($code)
    {
        $status = array(
            200 => "OK",
            404 => "Not found",
            500 => "Internal Server Error"
        );
        return (isset($status[$code])) ? $status[$code] : $status[500];
    }
    public function showLigas($ligas, $status)
    {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " " . $this->_requestStatus($status));
        echo json_encode($ligas);
    }
}
