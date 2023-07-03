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

    public function agregarPartido()
    {
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
            $this->view->response("Tienes que registrar todos los campos", 404);
        }
    }


    public function borrarPartido($params)
    {
        $id = $params[':ID'];
        $partido = $this->model->getPartido($id);
        if ($partido) {
            $result = $this->model->deletePartido($id);
            if ($result)
                if ($result)
                    $this->view->response("Partido eliminado correctamente.", 200);
                else
                    $this->view->response("Hubo un error al intentar eliminar el partido.", 400);
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
}
