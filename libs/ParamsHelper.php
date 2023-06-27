<?php

class ParamsHelper
{

    private $parameters = [
        "orderBy" => "orderFilter",
        "cantidad" => "catidadFilter"
    ];

    private $parts = [];

    public function __construct()
    {
        if (isset($_SERVER['QUERY_STRING']))
            parse_str($_SERVER['QUERY_STRING'], $this->parts);
    }

    public function armarFiltro()
    {
        $query = '';
        foreach ($this->parameters as $key => $valor) {
            if (array_key_exists($key, $this->parts)) {
                $query .= $this->$valor($this->parts[$key]);
            }
        }
        return $query;
    }

    private function orderFilter($valor)
    {
        if ($this->parts['resource'] == 'equipos')
            if (!$this->validarCamposEquipo($valor))
                return '';

        if ($this->parts['resource'] == 'jugadores')
            if (!$this->validarCamposJugador($valor))
                return '';

        $cadena = '';
        $cadena .= ' ORDER BY ' . $valor;
        if (isset($this->parts['order'])) {
            $order = strtoupper($this->parts['order']);
            if ($order == 'ASC' || $order == 'DESC')
                $cadena .= ' ' . $order;
        }
        return $cadena;
    }

    private function catidadFilter($valor)
    {
        $cadena = '';
        if ($valor > 0) {
            if (isset($this->parts["pagina"]) && $this->parts["pagina"] > 0) {
                $pag = $this->parts["pagina"];
                $cadena .= " LIMIT " . ($valor * $pag) - $valor . "," . $valor;
            } else {
                $cadena .= " LIMIT 1," . $valor;
            }
        }
        return $cadena;
    }

    private function validarCamposEquipo($valor)
    {
        if ($valor == 'id_equipo' || $valor == 'nombre')
            return true;
        else
            return false;
    }
    public function validarCamposJugador($valor)
    {
        if (
            $valor == 'id_jugador' || $valor == 'nombre' || $valor == 'apellido' || $valor == 'dni'
            || $valor == 'posicion'
        )
            return true;
        else
            return false;
    }
}
