<?
require_once '../api-models/EquipoModel.php';
require_once '../api-views/api.view.php';
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
        die("GET EQUIPOSSSSS");
    }
    public function getEquipo()
    {
        die("GET EQUIPO ");
    }
}
