<?php
require_once "router.php";
require_once "./app/controllers/LeagueController.php";
require_once "./app/controllers/TeamController.php";

define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
// crea el router
$router = new Router();

// define la tabla de ruteo

$router->addRoute('/equipos/ordenar/:CAMPO/:ORDEN','GET','TeamController', 'showAll');
$router->addRoute('/equipos/paginar/:PAGNUM','GET','TeamController','showAllLimit');


$router->addRoute('/ligas', 'GET', 'LeagueController', 'showLeagues');
$router->addRoute('/ligas/:ID', 'GET', 'LeagueController', 'showIDLeague');
$router->addRoute("/ligas/:ID", "DELETE", "LeagueController", "deleteLeague");
$router->addRoute("/ligas", "POST", "LeagueController", "addLeague");
$router->addRoute("/ligas/:ID", "PUT", "LeagueController", "updateLeague");

//teams
$router->addRoute('/equipos','GET','TeamController', 'showTeams');
$router->addRoute('/equipos/:ID', 'GET','TeamController','showIdTeam');
$router->addRoute('/equipos','POST','TeamController','addTeam');
$router->addRoute('/equipos/:ID', 'DELETE', 'TeamController', 'deleteTeam');
$router->addRoute('/equipos/:ID', 'PUT', 'TeamController', 'modifyTeam');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
