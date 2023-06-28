<?php
require_once './libs/Router.php';
require_once './app/controller/EquipoController.php';
require_once './app/controller/JugadorController.php';
require_once './app/controller/PartidoController.php';
require_once './app/controller/UserController.php';
require_once './libs/Utils.php';
// crea el router
$router = new Router();

// defina la tabla de ruteo
/*$router->addRoute('tasks', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); */


$router->addRoute('equipos', 'GET', 'EquipoController', 'getEquipos');
$router->addRoute('equipos/:PARAMETRO', 'GET', 'EquipoController', 'getEquipo');
$router->addRoute('equipos', 'POST', 'EquipoController', 'agregarEquipo');
$router->addRoute('equipos/:ID', 'PUT', 'EquipoController', 'actualizarEquipo');
$router->addRoute('equipos/:ID', 'DELETE', 'EquipoController', 'borrarEquipo');
$router->addRoute('equipos/:NOMBRE/jugadores', 'GET', 'EquipoController', 'getJugadoresxEquipo');

$router->addRoute('jugadores', 'GET', 'JugadorController', 'getJugadores');
$router->addRoute('jugadores/:ID', 'GET', 'JugadorController', 'getJugador');
$router->addRoute('jugadores', 'POST', 'JugadorController', 'registrarJugador');

$router->addRoute('partidos', 'GET', 'PartidoController', 'getPartidos');
$router->addRoute('partidos/:EQUIPO', 'GET', 'PartidoController', 'getPartidosxEquipo');
$router->addRoute('partidos', 'POST', 'PartidoController', 'agregarPartido');
$router->addRoute('partidos/:ID', 'DELETE', 'PartidoController', 'borrarPartido');

$router->addRoute('login', 'GET', 'UserController', 'login');

/*
var_dump($_GET["resource"]);
die();*/

// ejecuta la ruta (sea cual sea)


/*
echo Utils::normalizarURL($_GET["resource"]);
die();*/

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
