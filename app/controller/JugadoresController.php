<?php
require_once 'app/model/JugadorModel.php';
require_once 'app/view/api.view.php';

class JugadoresController
{
    private $model;
    private $view;
    private $data;
    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->model = new JugadorModel();
        } catch (Exception $e) {
            $this->view->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }

      private function getData()
    {
        return json_decode($this->data);
    }

    public function getJugadores(){
        $res = $this->model->getJugadores();
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response($res, 204);
    }

    public function getJugador($params){
        $parametro=$params[":ID"];
        if (is_numeric($parametro)) {
            $res = $this->model->getJugador($parametro);
        } elseif (is_string($parametro))
            $res = $this->model->getJugador(null, $parametro);

        if ($res) {
            $this->view->response($res, 200);
        } else
            $this->view->response("No existe jugador con este $parametro", 204);

    }






}