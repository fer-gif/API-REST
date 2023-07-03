<?php
require_once 'app/model/EquipoModel.php';
require_once 'app/model/PartidoModel.php';
require_once 'app/view/api.view.php';
require_once 'app/model/JugadorModel.php';
require_once './libs/ParamsHelper.php';
require_once './libs/AuthHelper.php';

class EquipoController
{

    private $model;
    private $view;
    private $jugadorModel;
    private $partidoModel;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->jugadorModel = new JugadorModel();
            $this->model = new EquipoModel();
            $this->partidoModel = new PartidoModel();
        } catch (Exception $e) {
            $this->view->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    public function getEquipos()
    {
        $filtro = new ParamsHelper();
        $res = $this->model->getEquipos($filtro);
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response("No existen equipos para los valores indicados.", 404);
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
        $this->esAdministrador();

        $datos = $this->getData();
        $this->comprobarParametro($datos);
        $nombre = trim($datos->nombre);
        $this->nombreDisponible($nombre);
        $ciudad = trim($datos->ciudad);
        if (isset($datos->socios))
            $socios = trim($datos->socios);
        else
            $socios = 0;
        $res = $this->model->addEquipo($nombre, $ciudad, $socios);
        if ($res)
            $this->view->response("Equipo creado correctamente. ID=" . $res, 201);
        else
            $this->view->response("Hubo un error al intentar agregar el equipo", 500);
    }

    public function actualizarEquipo($params)
    {
        $this->esAdministrador();

        $id = $params[':ID'];
        $datos = $this->getData();
        $this->comprobarParametro($datos);
        $nombre = trim($datos->nombre);
        $this->nombreDisponible($nombre, $id);
        $ciudad = trim($datos->ciudad);
        if (isset($datos->socios) && is_numeric($datos->socios))
            $socios = $datos->socios;
        else
            $socios = 0;
        $result = $this->model->updateEquipo($id, $nombre, $ciudad, $socios);
        if ($result)
            $this->view->response("Equipo editado correctamente. ID= " . $id, 200);
        else
            $this->view->response("Hubo un error al intentar editar el equipo", 400);
    }

    public function borrarEquipo($params)
    {
        $this->esAdministrador();

        $id = $params[':ID'];
        $equipo = $this->model->getEquipo($id);
        if ($equipo) {
            $result = $this->model->deleteEquipo($id);
            if ($result)
                if ($result)
                    $this->view->response("Equipo eliminado correctamente. ID=" . $id, 200);
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
            $filtro = new ParamsHelper();
            $jugadores = $this->jugadorModel->getJugadores($equipo, $filtro);
            if ($jugadores) {
                $this->view->response($jugadores, 200);
            } else {
                $this->view->response("No existen jugadores registrado en el equipo", 404);
            }
        } else {
            $this->view->response("El equipo no existe en la base de datos", 404);
        }
    }

    public function getPartidosxEquipo($parametro)
    {
        $equipo = $parametro[":EQUIPO"];
        $res = $this->model->getEquipo(null, $equipo);

        if ($res) {
            $partidos = $this->partidoModel->getPartidosxEquipo($equipo);
            if ($partidos) {
                $this->view->response($partidos, 200);
            } else {
                $this->view->response("No existe partidos para este equipo", 204);
            }
        } else {
            $this->view->response("No existe un equipo con ese id", 404);
        }
    }

    public function getPosiciones()
    {
    }
    private function nombreDisponible($nombre, $id = null)
    {
        $equipo = $this->model->getEquipo(null, $nombre);
        if ($equipo)
            if (!isset($id) || $equipo->id_equipo != $id) {
                $this->view->response("El equipo con el nombre " . $nombre . " ya existe", 409);
                die();
            }
    }
    private function comprobarParametro($datos)
    {
        if (!isset($datos->nombre) || empty(trim($datos->nombre)) || !isset($datos->ciudad) || empty(trim($datos->ciudad))) {
            $this->view->response("Debe indicar el nombre y la ciudad del equipo", 400);
            die();
        }
    }
    private function esAdministrador()
    {
        $aut = new AuthHelper();
        if (!$aut->validarPermisos() || !$aut->tienePermisos(5)) {
            $this->view->response("No posee permisos para realizar esta accion.", 401);
            die();
        }
    }
}
