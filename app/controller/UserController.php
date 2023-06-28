<?php
require_once 'app/model/UserModel.php';
require_once 'app/view/api.view.php';
require_once 'libs/AuthHelper.php';

class UserController
{

    private $userModel;
    private $vista;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->vista = new ApiView();
        try {
            $this->userModel = new UserModel();
        } catch (Exception $e) {
            $this->vista->response("Hubo un error en el servidor al intentar conectar con la base de datos", 500);
            die();
        }
    }
    private function getData()
    {
        return json_decode($this->data);
    }

    public function login()
    {
        $datos = $this->getData();
        $usuario = $datos->usuario;
        $pass = $datos->password;
        if (empty($usuario) || empty($pass)) {
            $this->vista->response("Debe indicar el nombre de usuario y la contraseña.", 400);
            return;
        }
        $usuario = $this->userModel->comprobarUsuario($usuario, $pass);
        if ($usuario) {
            $aut = new AuthHelper();
            $token = $aut->getToken($usuario);
            $this->vista->response($token, 200);
        } else {
            $this->vista->response("Usuario o contraseña incorrecta.", 400);
        }
    }
}
