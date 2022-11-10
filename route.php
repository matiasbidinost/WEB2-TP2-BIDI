<?php
require_once('router.php');
require_once "./app/controllers/LeagueController.php";
require_once "./app/controllers/TeamController.php";
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

    // rutas
    $r->addRoute('ligas', 'GET', 'LeagueController', 'showLeagues');
    //$r->addRoute('equipos', 'GET', 'TeamController', 'showTeams');//tambien nnecesito uno de teams?

    //Ruta por defecto.
    $r->setDefaultRoute("LeagueController", "showLeagues");
    //$r->setDefaultRoute("TeamController", "showTeams");
    //lo puedo eliminar, porq cummple la funcion del router viejo, que ahora mismo no es necesario para la entrega
    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>
