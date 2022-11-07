<?php
require_once "router.php";
require_once "./app/controllers/ApiController.php";

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
// crea el router
$router = new Router();

// define la tabla de ruteo

$router->addRoute('/ligas', 'GET', 'LeagueController', 'showLeagues');
//$router->addRoute('ligas', 'POST', 'ApiController', 'newLeagues');
//$router->addRoute('ligas/:ID', 'DELETE', 'ApiController', 'deleteLeague');
////$router->addRoute('ligas/:ID', 'PUT', 'ApiController', 'deleteLeague');

//$router->addRoute('equipos', 'GET', 'ApiController', 'showTeams');
//$router->addRoute('equipo/:ID', 'GET', 'ApiController', 'showTeam');
//$router->addRoute('equipo', 'POST', 'ApiController', 'newTeam');
//$router->addRoute('equipo/:ID', 'PUT', 'ApiController', 'modifyTeam');
//$router->addRoute('equipo/:ID', 'DELETE', 'ApiController', 'deleteTeam');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);









?>