<?php
require_once 'app/model/JugadorModel.php';
require_once 'app/model/EquipoModel.php';
require_once 'app/view/api.view.php';
require_once './libs/ParamsHelper.php';
require_once './libs/AuthHelper.php';

class JugadorController
{

    private $view;
    private $jugadorModel;
    private $equipoModel;
    private $data;

    public function __construct()
    {
        $this->data = file_get_contents("php://input");
        $this->view = new ApiView();
        try {
            $this->jugadorModel = new JugadorModel();
            $this->equipoModel = new EquipoModel();
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
        $filtro = new ParamsHelper();
        $res = $this->jugadorModel->getJugadores(null, $filtro);
        if ($res)
            $this->view->response($res, 200);
        else
            $this->view->response("No existen jugadores en la base de datos para los valores indicados", 404);
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
        $aut = new AuthHelper();
        if (!$aut->validarPermisos() || (!$aut->tienePermisos(5) && !$aut->tienePermisos(3))) {
            $this->view->response("No posee permisos para realizar esta accion.", 401);
            die();
        }
        $datos = $this->getData();
        $this->comprobarDatos($datos);
        $this->comprobarDisponibilidadDni($datos->dni);
        $equipo = $this->equipoModel->getEquipo($datos->id_equipo);
        if (!$equipo) {
            $this->view->response("El ID del equipo ingresado para este jugador es incorrecto.", 401);
            die();
        }
        $res = $this->jugadorModel->addJugador($datos->nombre, $datos->apellido, $datos->dni, $datos->posicion, $datos->telefono, $datos->edad, $datos->id_equipo);
        if ($res)
            $this->view->response("Jugador creado correctamente. ID=" . $res, 201);
        else
            $this->view->response("Hubo un error al intentar agregar el jugador", 500);
    }

    public function actualizarJugador($params)
    {
        $this->esAdministrador();
        $id = $params[':ID'];
        $datos = $this->getData();
        $this->comprobarDatos($datos);
        $this->comprobarDisponibilidadDni($datos->dni, $id);

        $res = $this->jugadorModel->updateJugador($id, $datos->nombre, $datos->apellido, $datos->dni, $datos->telefono, $datos->posicion, $datos->edad);
        if ($res)
            $this->view->response("Jugador editado correctamente. ID= " . $id, 201);
        else
            $this->view->response("Hubo un error al intentar editar el jugador.", 500);
    }

    public function eliminarJugador($params)
    {
        $this->esAdministrador();
        $id = $params[':ID'];
        $jugador = $this->jugadorModel->getJugador($id);
        if ($jugador) {
            $res = $this->jugadorModel->deleteJugador($id);
            if ($res) {
                $this->view->response("Jugador eliminado correctamente. ID= " . $id, 200);
            } else {
                $this->view->response("Hubo un error al intentar eliminar el jugador.", 500);
            }
        } else
            $this->view->response("Error al eliminar. No existe un jugador con el ID indicado.", 404);
    }

    private function comprobarDatos($datos)
    {
        if (empty($datos->nombre) || empty($datos->apellido) || empty($datos->dni) || empty($datos->edad) || empty($datos->posicion) || empty($datos->id_equipo)) {
            $this->view->response("Debe indicar los datos obligatorios", 400);
            die();
        }
        if (!is_numeric($datos->dni) || !is_numeric($datos->edad) || $datos->dni < 0 || $datos->edad < 0) {
            $this->view->response("Los campos DNI y edad debes ser un numero entero mayor a 0.", 400);
            die();
        }
        if ($datos->posicion !== "POR" && $datos->posicion !== "DEF" && $datos->posicion !== "MED" && $datos->posicion !== "DEL") {
            $this->view->response("La posicion ingresada no es valida.", 400);
            die();
        }
    }

    private function comprobarDisponibilidadDni($dni, $id = null)
    {
        $jugador = $this->jugadorModel->getJugador(null, $dni);
        if ($jugador) {
            if (!isset($id) || $jugador->id_jugador != $id) {
                $this->view->response("Ya existe un jugador con el DNI indicado", 400);
                die();
            }
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
