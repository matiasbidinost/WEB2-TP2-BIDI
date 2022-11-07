<?php
require_once "./app/controllers/ApiController.php";
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

    // rutas
    $r->addRoute('/ligas', 'GET', 'ApiController', 'showLeagues');

    //Ruta por defecto.
    $r->setDefaultRoute("ApiController", "showLeagues");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>
