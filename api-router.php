<?php
require_once './libs/Router.php';
require_once './app/controller/EquipoController.php';
require_once './app/controller/JugadorController.php';
require_once './app/controller/PartidoController.php';
require_once './app/controller/UserController.php';
require_once './libs/Utils.php';

$router = new Router();

$router->addRoute('equipos', 'GET', 'EquipoController', 'getEquipos');
$router->addRoute('equipos/:PARAMETRO', 'GET', 'EquipoController', 'getEquipo');
$router->addRoute('equipos', 'POST', 'EquipoController', 'agregarEquipo');
$router->addRoute('equipos/:ID', 'PUT', 'EquipoController', 'actualizarEquipo');
$router->addRoute('equipos/:ID', 'DELETE', 'EquipoController', 'borrarEquipo');
$router->addRoute('equipos/:NOMBRE/jugadores', 'GET', 'EquipoController', 'getJugadoresxEquipo');
$router->addRoute('equipos/:EQUIPO/partidos', 'GET', 'EquipoController', 'getPartidosxEquipo');

$router->addRoute('jugadores', 'GET', 'JugadorController', 'getJugadores');
$router->addRoute('jugadores/:ID', 'GET', 'JugadorController', 'getJugador');
$router->addRoute('jugadores', 'POST', 'JugadorController', 'registrarJugador');
$router->addRoute('jugadores/:ID', 'PUT', 'JugadorController', 'actualizarJugador');
$router->addRoute('jugadores/:ID', 'DELETE', 'JugadorController', 'eliminarJugador');

$router->addRoute('partidos', 'GET', 'PartidoController', 'getPartidos');
$router->addRoute('partidos/:ID', 'GET', 'PartidoController', 'getPartido');
$router->addRoute('partidos', 'POST', 'PartidoController', 'agregarPartido');
$router->addRoute('partidos/:ID', 'PUT', 'PartidoController', 'actualizarPartido');
$router->addRoute('partidos/:ID', 'DELETE', 'PartidoController', 'borrarPartido');

$router->addRoute('login', 'POST', 'UserController', 'login');

$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
