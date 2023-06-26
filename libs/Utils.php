<?php


class Utils
{
    public static function comprobarURL($url)
    {
        (filter_var($url, FILTER_VALIDATE_URL) !== false) ? true : false;
    }

    public static function normalizarURL($url)
    {
        $arreglo = explode('/', $url);
        $result = [];

        foreach ($arreglo as $elem) {
            $result[] = trim($elem);
        }
        print_r(implode('/', $result));
        //return ;
    }
}
