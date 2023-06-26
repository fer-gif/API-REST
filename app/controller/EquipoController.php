<?php
require_once 'app/model/EquipoModel.php';
require_once 'app/view/api.view.php';

class EquipoController
{

    private $model;
    private $view;

    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
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
        $res = $this->model->getEquipos("ORDER BY `nombre` DESC");
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
            $this->view->response("No existe un equipo con los parametros enviados", 204);
    }

    public function agregarEquipo()
    {
        $datos = $this->getData();
        if (empty(trim($datos->nombre))) {
            $this->view->response("Debe indicar el nombre del equipo que quiere agregar", 400);
            die();
        }
        $nombre = trim($datos->nombre);
        $equipo = $this->model->getEquipo(null, $nombre);
        if ($equipo) {
            $this->view->response("El equipo con el nombre " . $nombre . " ya existe", 409);
            die();
        }
        $res = $this->model->addEquipo($nombre);
        if ($res)
            $this->view->response("Equipo creado correctamente. ID=" . $res, 201);
        else
            $this->view->response("Hubo un error al intentar agregar el equipo", 500);
    }
}
