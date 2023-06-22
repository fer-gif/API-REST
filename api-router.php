<?php
require_once './libs/Router.php';
require_once './app/api-controllers/EquipoController.php';

// crea el router
$router = new Router();

// defina la tabla de ruteo
/*$router->addRoute('tasks', 'GET', 'TaskApiController', 'getTasks');
$router->addRoute('tasks/:ID', 'GET', 'TaskApiController', 'getTask');
$router->addRoute('tasks/:ID', 'DELETE', 'TaskApiController', 'deleteTask');
$router->addRoute('tasks', 'POST', 'TaskApiController', 'insertTask'); */

/*api/equipos		      
api/equipos/:id		  
api/equipos/:nombre
api/equipos		      
api/equipos/:id		  
api/equipos/:id		   */
$router->addRoute('equipos', 'GET', 'EquipoController', 'getEquipos');
$router->addRoute('equipos/:ID', 'GET', 'EquipoController', 'getEquipo');
$router->addRoute('equipos/:NOMBRE', 'GET', 'EquipoController', 'getEquipo');
$router->addRoute('equipos', 'POST', 'EquipoController', 'agregarEquipo');
$router->addRoute('equipos', 'PUT', 'EquipoController', 'actualizarEquipos');
$router->addRoute('equipos', 'DELETE', 'EquipoController', 'borrarEquipos');

var_dump($_GET["resource"]);
die();

// ejecuta la ruta (sea cual sea)
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);
