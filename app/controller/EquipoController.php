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
        $this->model = new EquipoModel();
        $this->view = new ApiView();

        $this->data = file_get_contents("php://input");
    }

    private function getData()
    {
        return json_decode($this->data);
    }

    public function getEquipos()
    {
        $res = $this->model->getEquipos();
    }
    public function getEquipo($params)
    {
        $parametro = $params[':PARAMETRO'];
        if (is_numeric($parametro)) {
            $res = $this->model->getEquipo($parametro);
        } elseif (is_string($parametro))
            $res = $this->model->getEquipo(null, $parametro);

        var_dump($res);
        die();
    }
}
