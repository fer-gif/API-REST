<?php
require_once 'app/model/JugadorModel.php';
require_once 'app/view/api.view.php';

class JugadorController
{

    private $view;
    private $jugadorModel;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->jugadorModel = new JugadorModel();
        } catch (Exception $e) {
            $this->view->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }
    private function getData()
    {
        return json_decode($this->data);
    }

    public function getJugadores()
    {
        $res = $this->jugadorModel->getJugadores();
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response("No existen jugadores en la base de datos", 204);
    }

    public function getJugador($params)
    {
        $param = $params[":ID"];
        $res = $this->jugadorModel->getJugador($param);
        if ($res) {
            $this->view->response($res, 200);
        } else
            $this->view->response("No existe jugador con ese ID", 400);
    }

    public function registrarJugador()
    {
        $datos = $this->getData();
        $this->comprobarDatos($datos);
        $this->comprobarDisponibilidadDni($datos->dni);
        var_dump($datos);
        die;
    }

    private function comprobarDatos($datos)
    {
        if (empty($datos->nombre) || empty($datos->apellido) || empty($datos->dni)) {
            $this->view->response("Debe indicar los datos obligatorios", 400);
            die();
        }
    }

    private function comprobarDisponibilidadDni($dni)
    {
        $jugador = $this->jugadorModel->getJugador(null, $dni);
        if ($jugador) {
            $this->view->response("Ya existe un jugador con el DNI indicado", 400);
            die();
        }
    }
}
