<?php
require_once 'app/model/PartidoModel.php';
require_once 'app/model/EquipoModel.php';
require_once 'app/view/api.view.php';

class PartidoController
{
    private $model;
    private $modelEquipo;
    private $view;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->model = new PartidoModel();
            $this->modelEquipo = new EquipoModel();
        } catch (Exception $e) {
            $this->view->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }

    public function getData()
    {
        return json_decode($this->data);
    }

    public function getPartidos()
    {
        $res = $this->model->getPartidos();
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response($res, 204);
    }

    public function getPartido($params)
    {
        $param = $params[":ID"];
        $res = $this->model->getPartido($param);
        if ($res) {
            $this->view->response($res, 200);
        } else
            $this->view->response("No existe partido con ese ID.", 404);
    }

    public function agregarPartido()
    {
        $this->esAdministrador();
        $datos = $this->getData();
        $this->comprobarEquiposDistintos($datos);
        $this->comprobarEquipos($datos);
        $this->comprobarPartido($datos);

        if (isset($datos->goles_equipo1) && isset($datos->goles_equipo2) && isset($datos->fecha)) {
            $equipo1 = $datos->id_equipo1;
            $equipo2 = $datos->id_equipo2;
            $goles1 = $datos->goles_equipo1;
            $goles2 = $datos->goles_equipo2;
            $fecha = $datos->fecha;
            $res = $this->model->addPartido($equipo1, $equipo2, $goles1, $goles2, $fecha);

            if ($res) {
                $this->view->response("Partido agregado correctamente. ID=" . $res, 201);
            } else
                $this->view->response("Hubo un error al intentar agregar el partido", 500);
        } else {
            $this->view->response("Tienes que registrar todos los campos", 400);
        }
    }

    public function actualizarPartido($params)
    {
        $this->esAdministrador();
        $id = $params[':ID'];
        $datos = $this->getData();
        $partido = $this->model->getPartido($id);
        if (!$partido) {
            $this->view->response("El partido que quiere editar no existe en la base de datos.", 404);
            die();
        }
        if (isset($datos->goles_equipo1) && isset($datos->goles_equipo2) && isset($datos->fecha)) {
            $goles1 = $datos->goles_equipo1;
            $goles2 = $datos->goles_equipo2;
            $fecha = $datos->fecha;
            $res = $this->model->updatePartido($id, $goles1, $goles2, $fecha);

            if ($res) {
                $this->view->response("Partido editado correctamente. ID=" . $id, 201);
            } else
                $this->view->response("Hubo un error al intentar editar el partido", 500);
        } else {
            $this->view->response("Tienes que registrar todos los campos", 400);
        }
    }

    public function borrarPartido($params)
    {
        $this->esAdministrador();
        $id = $params[':ID'];
        $partido = $this->model->getPartido($id);
        if ($partido) {
            $result = $this->model->deletePartido($id);
            if ($result)
                if ($result)
                    $this->view->response("Partido eliminado correctamente. ID=" . $id, 200);
                else
                    $this->view->response("Hubo un error al intentar eliminar el partido.", 500);
        } else
            $this->view->response("El partido que intenta eliminar no existe en la base de datos.", 404);
    }


    private function comprobarEquipos($datos)
    {
        $equipo1 = $this->modelEquipo->getEquipo($datos->id_equipo1);
        $equipo2 = $this->modelEquipo->getEquipo($datos->id_equipo2);
        if ($equipo1 === false ||  $equipo2 === false) {
            $this->view->response("El o los equipos que desea ingresar no existe", 404);
            die();
        }
    }

    private function comprobarEquiposDistintos($datos)
    {
        $equipo1 = $datos->id_equipo1;
        $equipo2 = $datos->id_equipo2;
        if ($equipo1 == $equipo2) {
            $this->view->response("los equipos no pueden ser iguales", 404);
            die();
        }
    }

    private function comprobarPartido($datos)
    {
        $partido = $this->model->getCruceDePartido($datos->id_equipo1, $datos->id_equipo2);
        if ($partido) {
            $this->view->response("El partido que desea ingresar ya existe", 409);
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
