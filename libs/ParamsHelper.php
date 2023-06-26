<?php

class ParamsHelper
{

    private $parts = [];
    public function __construct()
    {
        // $parts = [];
        if (isset($_SERVER['QUERY_STRING']))
            parse_str($_SERVER['QUERY_STRING'], $parts);
    }

    public function getCondicion()
    {
        $condicion = null;
        if (!empty($this->parts)) {
            switch ($this->parts[0]) {
                case 'OrderBy':
            }
        }
    }
}
