
<?php
require_once 'Conexion.php';
require_once './libs/ParamsHelper.php';
class EquipoModel
{
    private $connection;

    public function __construct()
    {
        try {
            $this->connection = new Conexion();
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function getEquipos($filtro)
    {
        $conexion = $this->connection->getConnection();
        $query = "SELECT * FROM equipos " . $filtro->armarFiltro();
        $sentence = $conexion->prepare($query);
        $valor = $filtro->getValor();
        if ($valor)
            $sentence->bindParam(":valor", $valor);
        $sentence->execute();

        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $equipos = $sentence->fetchAll();
        $conexion = null;
        return $equipos;
    }

    public function getEquipo($idEquipo = null, $nombre = null)
    {
        $conexion = $this->connection->getConnection();
        if (isset($idEquipo)) {
            $sentence = $conexion->prepare("SELECT * FROM equipos
            WHERE id_equipo=:idEquipo");
            $sentence->bindParam(":idEquipo", $idEquipo);
        } elseif (isset($nombre)) {
            $sentence = $conexion->prepare("SELECT * FROM equipos
            WHERE nombre=:nombre");
            $sentence->bindParam(":nombre", $nombre);
        } else {
            return null;
            exit();
        }
        $sentence->execute();
        $sentence->setFetchMode(PDO::FETCH_OBJ);
        $equipo = $sentence->fetch();

        return $equipo;
    }


    public function addEquipo($nombre, $ciudad, $socios)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("INSERT INTO equipos(nombre,ciudad,socios) VALUES(?,?,?)");
        $sentence->execute(array($nombre, $ciudad, $socios));
        $lastId = $conexion->lastInsertId();
        $conexion = null;
        return $lastId;
    }

    public function deleteEquipo($idEquipo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("DELETE FROM equipos WHERE id_equipo=?");
        $response = $sentence->execute(array($idEquipo));
        $conexion = null;

        return $response;
    }

    public function updateEquipo($idEquipo, $nombre, $ciudad, $socios)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET nombre = :nombre, ciudad = :ciudad, socios = :socios
                                    WHERE id_equipo = :idEquipo");
        $sentence->bindParam(":nombre", $nombre);
        $sentence->bindParam(":ciudad", $ciudad);
        $sentence->bindParam(":socios", $socios);
        $sentence->bindParam(":idEquipo", $idEquipo);
        $response = $sentence->execute();
        $conexion = null;
        return $response;
    }

    public function setEscudo($idEquipo, $escudo)
    {
        $conexion = $this->connection->getConnection();
        $sentence = $conexion->prepare("UPDATE equipos
                                    SET escudo = :escudo
                                    WHERE id_equipo = :idEquipo");
        $sentence->bindParam(":escudo", $escudo);
        $sentence->bindParam(":idEquipo", $idEquipo);
        $response = $sentence->execute();
        $conexion = null;
        return $response;
    }
}
