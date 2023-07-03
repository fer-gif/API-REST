<?php

class ParamsHelper
{
    private $parameters = [
        "filter" => "aplicarFiltro",    //value
        "orderBy" => "orderFilter",     //order
        "cantidad" => "catidadFilter"   //Pagina
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
                $query .= $this->$valor($this->parts[$key]); //$this->orderFilter($this->parts["orderBy"])
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
                $cadena .= " LIMIT 0," . $valor;
            }
        }
        return $cadena;
    }

    private function aplicarFiltro($valor)
    {
        if ($this->parts['resource'] == 'equipos')
            if (!$this->validarCamposEquipo($valor))
                return '';

        if ($this->parts['resource'] == 'jugadores')
            if (!$this->validarCamposJugador($valor))
                return '';

        $cadena = '';
        if (isset($this->parts['value'])) {
            $cadena .= ' WHERE ' . $valor . "=:valor";
        }
        return $cadena;
    }

    public function getValor()
    {
        if (isset($this->parts['filter']) && isset($this->parts['value']) && !empty($this->parts['value']))
            return $this->parts['value'];
        else
            return null;
    }

    private function validarCamposEquipo($valor)
    {
        if ($valor == 'id_equipo' || $valor == 'nombre' || $valor == 'ciudad' || $valor == 'socios')
            return true;
        else
            return false;
    }
    public function validarCamposJugador($valor)
    {
        if (
            $valor == 'nombre' || $valor == 'apellido' || $valor == 'dni'
            || $valor == 'posicion' || $valor == 'edad' || $valor == 'telefono'
        )
            return true;
        else
            return false;
    }
}
