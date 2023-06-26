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

    public function getEquipos()
    {
        $res = $this->model->getEquipos();
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response($res, 204);
    }
    public function getEquipo($params)
    {
        var_dump($params);
        die();
        $parametro = $params[':PARAMETRO'];
        if (is_numeric($parametro)) {
            $res = $this->model->getEquipo($parametro);
        } elseif (is_string($parametro))
            $res = $this->model->getEquipo(null, $parametro);

        if ($res) {
            //VER
            unset($res->escudo);
            $this->view->response($res, 200);
        } else
            $this->view->response($res, 204);
    }

    public function agregarEquipo()
    {
        print("LLEGA ");
        die();
        $datos = $this->getData();
        $nombre = $datos->nombre;
        $equipo = $this->model->getEquipo(null, $nombre);
        if ($equipo) {
            $this->view->response("El equipo con el nombre " . $nombre . " ya existe", 409);
            exit();
        }
        $res = $this->model->addEquipo($nombre);
        if ($res)
            $this->view->response("Equipo creado correctamente. ID=" . $res, 201);
        else
            $this->view->response("Hubo un error al intentar agregar el equipo", 500);
    }
}
