<?php
require_once './libs/Router.php';
require_once './app/controller/EquipoController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
/*$router->addRoute('tasks', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); */


$router->addRoute('equipos', 'GET', 'EquipoController', 'getEquipos');
$router->addRoute('equipos/:PARAMETRO', 'GET', 'EquipoController', 'getEquipo');
//$router->addRoute('equipos/:NOMBRE', 'GET', 'EquipoController', 'getEquipoxNombre');
$router->addRoute('equipos', 'POST', 'EquipoController', 'agregarEquipo');
$router->addRoute('equipos', 'PUT', 'EquipoController', 'actualizarEquipos');
$router->addRoute('equipos', 'DELETE', 'EquipoController', 'borrarEquipos');
/*
var_dump($_GET["resource"]);
die();*/

// ejecuta la ruta (sea cual sea)
/*
$parts = [];
parse_str($_SERVER['QUERY_STRING'], $parts);
*/
var_dump($_GET['resource']);
die;
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
