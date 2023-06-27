<?php
require_once 'app/model/EquipoModel.php';
require_once 'app/view/api.view.php';
require_once 'app/model/JugadorModel.php';

class EquipoController
{

    private $model;
    private $view;
    private $jugadorModel;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->jugadorModel = new JugadorModel();
            $this->model = new EquipoModel();
        } catch (Exception $e) {
            $this->view->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }

    private function getData()
    {
        return json_decode($this->data);
    }
    /*
ORDER BY nombre DESC
*/
    public function getEquipos()
    {
        $parts = [];
        parse_str($_SERVER['QUERY_STRING'], $parts);
        //$parts = explode("&", $_SERVER['QUERY_STRING']);
        var_dump(array_key_exists("ORDERBY", $parts));
        die;
        $res = $this->model->getEquipos();
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response("No existen equipos", 204);
    }
    public function getEquipo($params)
    {
        $parametro = $params[':PARAMETRO'];
        if (is_numeric($parametro)) {
            if ($parametro > 0)
                $res = $this->model->getEquipo($parametro);
            else {
                $this->view->response("El ID indicado debe ser mayor que 0", 400);
                die();
            }
        } elseif (is_string($parametro))
            $res = $this->model->getEquipo(null, $parametro);

        if ($res) {
            //VER
            unset($res->escudo);
            $this->view->response($res, 200);
        } else
            $this->view->response("No existe un equipo con los parametros enviados", 404);
    }

    public function agregarEquipo()
    {
        $datos = $this->getData();
        $this->comprobarParametro($datos);
        $nombre = trim($datos->nombre);
        $this->nombreDisponible($nombre);
        $res = $this->model->addEquipo($nombre);
        if ($res)
            $this->view->response("Equipo creado correctamente. ID=" . $res, 201);
        else
            $this->view->response("Hubo un error al intentar agregar el equipo", 500);
    }

    public function actualizarEquipo($params)
    {
        $id = $params[':ID'];
        $datos = $this->getData();
        $this->comprobarParametro($datos);
        $nombre = trim($datos->nombre);
        $this->nombreDisponible($nombre);

        $result = $this->model->updateEquipo($id, $datos->nombre);
        if ($result)
            $this->view->response("Equipo editado correctamente", 200);
        else
            $this->view->response("Hubo un error al intentar editar el equipo", 400);
    }

    public function borrarEquipo($params)
    {
        $id = $params[':ID'];
        $equipo = $this->model->getEquipo($id);
        if ($equipo) {
            $result = $this->model->deleteEquipo($id);
            if ($result)
                if ($result)
                    $this->view->response("Equipo eliminado correctamente.", 200);
                else
                    $this->view->response("Hubo un error al intentar eliminar el equipo.", 400);
        } else
            $this->view->response("El equipo que intenta eliminar no existe en la base de datos.", 404);
    }

    public function getJugadoresxEquipo($params)
    {
        $equipo = $params[':NOMBRE'];
        $res = $this->model->getEquipo(null, $equipo);
        if ($res) {
            $jugadores = $this->jugadorModel->getJugadores($equipo);
            if ($jugadores) {
                $this->view->response($jugadores, 200);
            } else {
                //PREGUNTAR POR EL NUMERO DE ERROR
                $this->view->response("No existen jugadores registrado en el equipo", 404);
            }
        } else {
            $this->view->response("El equipo no existe en la base de datos", 404);
        }
    }
    private function nombreDisponible($nombre)
    {
        $equipo = $this->model->getEquipo(null, $nombre);
        if ($equipo) {
            $this->view->response("El equipo con el nombre " . $nombre . " ya existe", 409);
            die();
        }
    }
    private function comprobarParametro($datos)
    {
        if (!isset($datos->nombre) || empty(trim($datos->nombre))) {
            $this->view->response("Debe indicar el nombre del equipo que quiere editar", 400);
            die();
        }
    }
}
