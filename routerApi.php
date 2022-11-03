<?php
require_once "./libs/RouterConfig.php";
require_once "./app/controllers/ApiController.php";

// crea el router
$router = new Router();

// define la tabla de ruteo
$router->addRoute('equipos', 'POST', 'ApiController', 'showTeams');
$router->addRoute('ligas', 'POST', 'ApiController', 'showLeagues');
$router->addRoute('equipo/:ID', 'GET', 'ApiController', 'showTeam');
$router->addRoute('tareas/:ID', 'GET', 'ApiController', 'obtenerTarea');

// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);









?>