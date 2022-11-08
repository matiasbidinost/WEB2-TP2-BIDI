<?php

class TeamView
{
    public function showTeams($equipos , $status)
    {
        header("Content-Type: application/json");
        header("HTTP/1.1 " . $status . " "); // . $this->_requestStatus($status));
        echo json_encode($equipos);
    }
}